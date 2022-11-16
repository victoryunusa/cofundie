<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\HasPayment;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Gateway;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class SubscribeController extends Controller
{
    use HasPayment;

    public function index(Plan $plan)
    {
        $gateways = Gateway::whereStatus(1)->whereNotIn('name', ['manual'])->get();
        return view('frontend.payment.index', compact('plan', 'gateways'));
    }

    public function payment(Request $request)
    {
        $gateway = Gateway::findOrFail($request->get('gateway'));
        $plan = Plan::findOrFail($request->get('plan'));

        abort_if(!$plan->status || !$gateway->status || $gateway->name == 'manual', 404);

        return view('frontend.payment.payment', compact('plan', 'gateway'));
    }

    public function validateCoupon(Request $request, Plan $plan)
    {
        $coupon = Coupon::whereCode($request->input('code'))
            ->wherePlanId($plan->id)
            ->first();
        $gateway = Gateway::findOrFail($request->input('gateway'));

        if ($coupon && $coupon->orders()->count() == $coupon->max_limit) {
            Session::forget('coupon');
            return response()->json([
                'message' => __('The coupon usage limit exceed'),
                'errors' => [
                    'coupon_code' => [
                        __('The coupon usage limit exceed')
                    ]
                ]
            ], 404);
        }

        if (!$coupon) {
            Session::forget('coupon');
            return response()->json([
                'message' => __('The coupon code is invalid'),
                'errors' => [
                    'coupon_code' => [
                        __('The coupon code is invalid')
                    ]
                ]
            ], 404);
        } else {
            Session::put('coupon', $coupon);

            return response()->json([
                'isValid' => true,
                'message' => __('Coupon applied successfully'),
                'html' => $this->getPaymentInformation($request, $plan, $gateway)
            ]);
        }
    }

    public function removeCoupon(Request $request, Plan $plan)
    {
        Session::forget('coupon');
        $gateway = Gateway::findOrFail($request->input('gateway'));

        return response()->json([
            'message' => __('Coupon removed successfully'),
            'html' => $this->getPaymentInformation($request, $plan, $gateway)
        ]);
    }

    public function changeInterval(Request $request, Plan $plan, Gateway $gateway)
    {
        return response()->json([
            'isValid' => true,
            'html' => $this->getPaymentInformation($request, $plan, $gateway)
        ]);
    }

    public function getPaymentInformation(Request $request, Plan $plan, Gateway $gateway)
    {
        // Set Interval
        $interval = $request->input('interval');
        if (!in_array($interval, ['Monthly', 'Yearly'])) {
            return response()->json([
                'message' => __('Invalid interval, Please reload the page')
            ], 422);
        }
        $plan->interval = $interval;

        // Calculate Plan Discount
        $planDiscount = 0;
        if ($plan->discount_applied_on == "Monthly" && $plan->interval == "Monthly") {
            $planDiscount = $plan->monthly_price < 1 ? 0 : (($plan->monthly_price * $plan->monthly_discount) / 100);
        } elseif ($plan->discount_applied_on == "Yearly" && $plan->interval == "Yearly") {
            $planDiscount = $plan->yearly_price < 1 ? 0 : (($plan->yearly_price * $plan->yearly_discount) / 100);
        }

        $amount = ($plan->interval == "Monthly" ? $plan->monthly_price : $plan->yearly_price);
        $amountAfterPlanDiscount = $amount - $planDiscount;

        // Calculate Coupon Discount
        $coupon = Session::get('coupon');
        if (isset($coupon)) {
            $couponDiscount = $coupon->is_percent ? (($amountAfterPlanDiscount * $coupon->discount) / 100) : $coupon->discount;
        } else {
            $couponDiscount = 0;
        }

        $subtotal = $amountAfterPlanDiscount - $couponDiscount;
        $total = convert_money_direct($subtotal, default_currency(), $gateway->currency) + $gateway->charge;
        Session::put('subtotal', $subtotal);

        return view('frontend.payment.paymentInformation', compact('gateway', 'plan', 'coupon', 'amount', 'subtotal', 'total'))->render();
    }

    public function makePayment(Request $request, Plan $plan, Gateway $gateway)
    {
        $validated = $request->validate([
            'coupon' => ['nullable', 'exists:coupons,code'],
            'interval' => ['required', 'string', Rule::in(['Monthly', 'Yearly'])],
            'agree' => ['required', 'accepted']
        ]);

        //Validate Coupon
        if ($request->input('coupon')) {
            $coupon = Coupon::whereCode($validated['coupon'])->firstOrFail();
            if ($coupon->plan_id !== $plan->id) {
                return redirect()->back()->with('error', __("Invalid coupon provided"));
            }
        }

        $subtotal = Session::get('subtotal');
        // Store data to session
        Session::put('paymentData', [
            'plan' => $plan,
            'gateway' => $gateway,
            'coupon' => $coupon ?? null,
            'interval' => $validated['interval'],
            'subtotal' => $subtotal
        ]);

        $convertedAmount = convert_money_direct($subtotal, default_currency(), $gateway->currency);
        $data = [
            'currency' => $gateway->currency->code,
            'name' => \Auth::user()->name,
            'email' => \Auth::user()->email,
            'phone' => \Auth::user()->phone,
            'billName' => "Subscription Payment",
            'amount' => $convertedAmount,
            'test_mode' => $gateway->test_mode,
            'charge' => $gateway->charge,
            'pay_amount' => round($convertedAmount + $gateway->charge, 2),
            'gateway_id' => $gateway->id,
            'payment_type' => 'subscription_payment',
            'request_from' => 'merchant'
        ];

        Session::put('without_tax', true);
        Session::put('fund_callback.success_url', '/payment/success');
        Session::put('fund_callback.cancel_url', '/payment/failed');
        if (!Auth::check()) {
            Session::put('without_auth', true);
        } else {
            Session::put('without_auth', false);
        }
        return $this->proceedToPayment($request, $gateway, $data);
    }
}
