<?php

namespace App\Http\Controllers;

use App\Helpers\HasPayment;
use App\Mail\SendSubscriptionPurchaseInvoice;
use App\Models\PlanOrder;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;
use Mail;
use Session;
use Throwable;

class PaymentController extends Controller
{
    use HasPayment;

    /**
     * @throws Throwable
     */
    public function success()
    {
        $paymentInfo = Session::get('payment_info');
        abort_if(!$paymentInfo, 404);
        if ($paymentInfo['payment_type'] == 'subscription_payment') {
            return $this->subscriptionPayment($paymentInfo);
        }
    }

    public function failed()
    {
        return view('payment.failed');
    }

    private function subscriptionPayment($paymentInfo)
    {
        DB::beginTransaction();
        try {
            $paymentData = Session::get('paymentData');
            $plan = $paymentData['plan'];
            $gateway = $paymentData['gateway'];
            $subtotal = $paymentData['subtotal'];
            $coupon = $paymentData['coupon'] ?? null;
            $interval = $paymentData['interval'];

            $user = Auth::user();
            $willExpire = Carbon::today()->add('1 '.str($interval)->remove('ly'));

            // Create Order
            $order = PlanOrder::forceCreate([
                "user_id" => $user->id,
                "plan_id" => $plan->id,
                "coupon_id" => $coupon->id ?? null,
                "amount" => $subtotal,
                "tax" => 0,
                "will_expire" => $willExpire,
                "trx" => $paymentInfo['payment_id'],
                "gateway_id" => $gateway->id,
                "status" => $paymentInfo['payment_status'],
            ]);

            //Update User Info;
            $user->update([
                'will_expire' => ($user->plan_id == $plan->id && $user->will_expire > today())
                    ? Carbon::parse($user->will_expire)->add('1 '.str($interval)->remove('ly'))
                    : $willExpire,
                'plan_id' => $plan->id
            ]);

            DB::commit();

            // Send Email to Author and Customer
            if (config('system.queue.mail')) {
                Mail::to(Auth::user())->queue(new SendSubscriptionPurchaseInvoice($order));
            } else {
                Mail::to(Auth::user())->send(new SendSubscriptionPurchaseInvoice($order));
            }

            $this->clearSessions();

            return to_route('user.dashboard.index')->with('success', __("Subscription purchased successfully"));
        } catch (Throwable $exception) {
            DB::rollBack();
            $this->clearSessions();

            throw $exception;
        }
    }
}
