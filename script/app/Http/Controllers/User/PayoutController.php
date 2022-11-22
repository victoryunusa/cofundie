<?php

namespace App\Http\Controllers\User;

use App\Mail\OtpMail;
use App\Models\Payout;
use App\Mail\PayoutMail;
use App\Models\PayoutMethod;
use Illuminate\Http\Request;
use App\Models\UserPayoutMethod;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class PayoutController extends Controller
{
    public function index() {
        $pending_amount = Payout::whereStatus('pending')->sum('amount');
        $methods = PayoutMethod::whereStatus(1)->with('usermethod', 'currency')->latest()->get();
        return view('user.payout.index', compact('methods', 'pending_amount'));
    }

    public function setup($method_id) {

        $method = PayoutMethod::whereStatus(1)->findOrFail($method_id);
        UserPayoutMethod::create([
            'user_id' => auth()->id(),
            'payout_method_id' => $method_id,
            'payout_infos' => $method->date
        ]);
        return back()->with('success_msg', __('Payout method connected successfully. Please edit this with your credentials.'));
    }

    public function edit($method_id) {
        $usermethod = UserPayoutMethod::where('payout_method_id', $method_id)->first();
        if (!$usermethod) {
            abort(404);
        }
        $method = PayoutMethod::whereStatus(1)->findOrFail($method_id);
        return view('user.payout.edit', compact('method', 'usermethod'));
    }

    public function update(Request $request, $method_id) {
        $usermethod = UserPayoutMethod::where('payout_method_id', $method_id)->first();
        if (!$usermethod) {
            abort(404);
        }
        $data = json_encode($request->inputs);
        $usermethod->update([
            'payout_infos' => $data
        ]);
        return response()->json([
            'message' => __('Payout updated successfully.')
        ]);
    }

    public function makepayout($method_id) {
        $usermethod = UserPayoutMethod::where('payout_method_id', $method_id)->first();
        if (!$usermethod) {
            abort(404);
        }
        $method = PayoutMethod::whereStatus(1)->findOrFail($method_id);
        return view('user.payout.payout-request', compact('method', 'usermethod'));
    }

    public function getotp(Request $request, $method_id) {
        $request->validate([
            'amount' => 'required|integer',
        ]);

        $method = PayoutMethod::findOrFail($method_id);
        if ($method) {
            if (auth()->user()->wallet >= $request->amount) {
                if ($method->min_limit <= $request->amount) {
                    if ($method->max_limit >= $request->amount) {

                        $otp = rand();
                        session()->put('payout_otp', $otp);
                        session()->put('payout_amount', $request->amount);

                        try {
                            if (env('QUEUE_MAIL')) {
                                Mail::to(auth()->user()->email)->queue(new OtpMail($otp));
                            } else {
                                Mail::to(auth()->user()->email)->send(new OtpMail($otp));
                            }
                        } catch (Exception $e) {
                               return response()->json('The Mail Settings Has Issues', 404);
                           
                        }

                        return response()->json([
                            'redirect' => route('user.payout.otp', $method_id),
                            'message' => "An OTP has been sended to your mail. Please check and confirm."
                        ], 200);
                    } else {
                        return response()->json('Maximum transaction amount '.$method->max_limit, 404);
                    }
                } else {
                    return response()->json('Minimum transaction amount '.$method->min_limit, 404);
                }
            } else {
                return response()->json('Insufficient wallet. Your wallet is '. (auth()->user()->wallet ?? 0), 404);
            }
        } else {
            return response()->json('Method not found.', 404);
        }
    }

    public function otp($method_id) {
        $payout_otp = session()->get('payout_otp');
        $payout_amount = session()->get('payout_amount');
        if (!$payout_otp && !$payout_amount) {
            return back();
        }
        $method = PayoutMethod::findOrFail($method_id);
        $plan_charge = auth()->user()->plan_meta['meta']['withdraw_charge'] ?? 0;
        $plan_charge = ($payout_amount / 100) * $plan_charge;

        if ($method->percent_charge > 0) {
            $amount = $payout_amount / 100;
            $charge = $amount * $method->percent_charge;
        } else {
            $charge = $method->fixed_charge;
        }

        session()->put('plan_charge', $plan_charge);
        session()->put('method_charge', $charge);

        return view('user.payout.success');
    }

    public function success(Request $request, $method_id) {
        $payout_otp = session()->get('payout_otp');
        $payout_amount = session()->get('payout_amount');
        if (!$payout_otp && !$payout_amount) {
            abort(404);
        }
        $method = PayoutMethod::findOrFail($method_id);

        if ($payout_otp == $request->otp) {

            $total_charge = session('plan_charge') + session('method_charge');

            DB::beginTransaction();
            try {
                $payout = Payout::create([
                    'charge' => $total_charge,
                    'user_id' => auth()->id(),
                    'amount' => $payout_amount,
                    'currency_id' => $method->currency_id,
                    'payout_method_id' => $method_id,
                ]);

                auth()->user()->update([
                    'wallet' => auth()->user()->wallet - $payout_amount
                ]);

               

                session()->forget('payout_otp');
                session()->forget('payout_amount');
                session()->forget('method_charge');
                session()->forget('plan_charge');

                DB::commit();

                

            } catch (\Throwable $th) {
                DB::rollback();
                return response()->json([
                    'message' =>  __('Something was wrong, Please contact with author.'),
                ]);
            }

             // Send Email to admin
            try {
                if (env('QUEUE_MAIL')) {
                    Mail::to(env('MAIL_TO'))->queue(new PayoutMail($payout));
                } else {
                    Mail::to(env('MAIL_TO'))->send(new PayoutMail($payout));
                }
            } catch (Exception $e) {
                
            }

            return response()->json([
                    'status' => 200,
                    'redirect' => route('user.payout.index'),
                    'message' => __('Payout request successfully.'),
                ]);
        } else {
            
            return response()->json(__('Your OTP is incorrect please check your mail and confirm.'), 404);
        }
    }

}
