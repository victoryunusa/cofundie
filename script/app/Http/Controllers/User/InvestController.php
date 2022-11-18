<?php

namespace App\Http\Controllers\User;

use Throwable;
use Carbon\Carbon;
use App\Rules\Phone;
use App\Models\Gateway;
use App\Models\Project;
use App\Models\Investment;
use App\Models\Installment;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class InvestController extends Controller
{
    public function index()
    {
        $invests = Investment::whereUserId(auth()->id())->with('gateway', 'project.nextschedule')->latest()->paginate();
        return view('user.invests.index', compact('invests'));
    }

    public function investmentLogs()
    {
        $invests = Investment::whereUserId(auth()->id())->with('gateway', 'project.nextschedule', 'user')
                    ->when(request('search'), function($q) {
                        $q->where('trx', 'LIKE', '%'.request('search').'%');
                    })
                    ->latest()
                    ->paginate();
        return view('user.invests.logs', compact('invests'));
    }

    public function plans()
    {
        $projects = Project::with('meta', 'is_installment')->whereStatus(1)->latest()->get();
        $invests = Investment::whereUserId(auth()->id())->pluck('project_id')->toArray();
        $investments = Investment::with('project')->latest()->whereUserId(auth()->id())->get();
        return view('user.invests.plans', compact('projects', 'invests', 'investments'));
    }

    public function create()
    {
        $amount = Session::get('invest_amount');
        if (empty($amount) && $amount == null && $amount == 0) {
            return to_route('user.invests.plans', ['trigger' => 'invest-modal']);
        }
        $gateways = Gateway::whereStatus(1)
            ->with('currency')
            ->whereNotIn('name', ['From Wallet'])
            ->get();

        return view('user.payment.create', compact('gateways', 'amount'));
    }

    public function investPayment(Request $request)
    {
        $request->validate([
            'amount' => 'required|integer',
            'project_id' => 'required|integer',
        ]);
        $invests = Investment::whereUserId(auth()->id())->pluck('project_id')->toArray();
        if (in_array($request->project_id, $invests)) {
            return response()->json([
                'message' => __("Already invest."),
            ], 403);
        }
        $amount = $request->amount;
        $project = Project::find($request->project_id);
        if ($project) {
            if ($amount >= $project->min_invest) {
                if ($amount <= $project->max_invest) {
                    $invest_amount = Investment::where('project_id', $project->id)->sum('amount');
                    $limit_amount = $project->max_invest_amount - $invest_amount;

                    if ($limit_amount > $amount) {
                        Session::put('invest_amount', $amount);
                        Session::put('project', $project);
                        return response()->json([
                            'message' => __('Great! You are redirect to the next step.'),
                            'redirect' => route('user.invests.create'),
                        ]);
                    } else {
                        return response()->json([
                            'message' => __("You can't invest bigger then ") . $limit_amount,
                        ], 403);
                    }
                } else {
                    return response()->json([
                        'message' => __("Maximum investment is ") . $project->max_invest,
                    ], 403);
                }
            } else {
                return response()->json([
                    'message' => __("Minimum investment is ") . $project->min_invest,
                ], 403);
            }
        } else {
            return response()->json([
                'message' => __("Plan not found."),
            ], 403);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|integer',
            'project_id' => 'required|integer',
        ]);
        $invests = Investment::whereUserId(auth()->id())->pluck('project_id')->toArray();
        if (in_array($request->project_id, $invests)) {
            return response()->json([
                'message' => __("Already invest."),
            ], 403);
        }
        $project = Project::find($request->project_id);
        if ($project) {
            if ($request->amount <= auth()->user()->wallet) {
                if ($request->amount >= $project->min_invest) {
                    if ($request->amount <= $project->max_invest) {

                        $invest_amount = Investment::where('project_id', $project->id)->sum('amount');
                        $limit_amount = $project->max_invest_amount - $invest_amount;

                        if ($limit_amount > $request->amount) {
                            $share = ($request->amount * 100) / $project->max_invest_amount;

                            \DB::beginTransaction();
                            try {

                                auth()->user()->update([
                                    'wallet' => auth()->user()->wallet - $request->amount,
                                ]);

                                Investment::create([
                                    'trx' => Str::uuid(),
                                    'share' => $share,
                                    'user_id' => auth()->id(),
                                    'gateway_id' => 'Invest Using Balance',
                                    'amount' => $request->amount,
                                    'project_id' => $request->project_id,
                                    'is_returnable' => 1,
                                    'is_installment' => 0,
                                ]);

                                Transaction::create([
                                    'user_id' => auth()->id(),
                                    'currency_id' => default_currency()->id,
                                    'amount' => $request->amount,
                                    'rate' => default_currency()->rate,
                                    'reason' => "Invest",
                                    'name' => auth()->user()->name,
                                    'email' => auth()->user()->email,
                                ]);

                                \DB::commit();

                                return response()->json([
                                    'message' => __("Investment successfully."),
                                    'redirect' => route('user.invests.index'),
                                ]);
                            } catch (Throwable $th) {
                                \DB::rollback();
                                return response()->json([
                                    'message' => __("Something was wrong, Please contact with author."),
                                    'redirect' => route('user.invests.index'),
                                ], 403);
                            }
                        } else {
                            return response()->json([
                                'message' => __("You can't invest bigger then ") . $limit_amount,
                            ], 403);
                        }
                    } else {
                        return response()->json([
                            'message' => __("Maximum investment is ") . $project->max_invest,
                        ], 403);
                    }
                } else {
                    return response()->json([
                        'message' => __("Minimum investment is ") . $project->min_invest,
                    ], 403);
                }
            } else {
                return response()->json([
                    'message' => __("You have not sufficient balance. Please deposit or payment directly."),
                ], 403);
            }
        } else {
            return response()->json([
                'message' => __("Plan not found."),
            ], 403);
        }
    }

    public function makePayment(Request $request, Gateway $gateway)
    {
        $request->validate([
            'phone' => [
                Rule::requiredIf(fn() => $gateway->phone_required),
                new Phone,
            ],
        ]);
        $amount = Session::get('invest_amount');
        Session::put('fund_callback.success_url', '/user/invests/payment/success');
        Session::put('fund_callback.cancel_url', '/user/invests/payment/failed');

        if ($gateway->is_auto == 0) {
            $request->validate([
                'comment' => ['nullable', 'string', 'max:255'],
                'screenshot' => ['nullable', 'image', 'max:2048'], // 2MB
            ]);

            $request->validate([
                'comment' => ['required', 'string', 'max:255'],
                'screenshot' => ['required', 'image', 'max:2048'], // 2MB
            ]);

            $payment_data['comment'] = $request->input('comment');
            if ($request->hasFile('screenshot')) {
                $path = 'uploads' . '/payments' . date('/y/m/');
                $name = uniqid() . date('dmy') . time() . "." . $request->file('screenshot')->getClientOriginalExtension();
                Storage::disk(config('filesystems.default'))->put($path . $name, file_get_contents(Request()->file('screenshot')));
                Storage::disk(config('filesystems.default'))->url($path . $name);
                $payment_data['screenshot'] = $path . $name;
            }
        }

        $payment_data['currency'] = $gateway->currency->code ?? 'USD';
        $payment_data['email'] = auth()->user()->email;
        $payment_data['name'] = auth()->user()->name;
        $payment_data['phone'] = $request->input('phone');
        $payment_data['billName'] = __('Make Invest');
        $payment_data['amount'] = $amount;
        $payment_data['test_mode'] = $gateway->test_mode;
        $payment_data['charge'] = $gateway->charge ?? 0;
        $payment_data['pay_amount'] = round($amount + $gateway->charge, 2);
        $payment_data['gateway_id'] = $gateway->id;
        $payment_data['payment_type'] = 'invest';
        $payment_data['request_from'] = 'merchant';

        $gateway_info = json_decode($gateway->data, true);
        if (!empty($gateway_info)) {
            foreach ($gateway_info as $key => $info) {
                $payment_data[$key] = $info;
            }
        }

        $redirect = $gateway->namespace::make_payment($payment_data);
        return $request->expectsJson() ? response()->json(['message' => __('Great! You are redirect to next step.'), 'redirect' => $redirect]) : $redirect;
    }

    public function failed()
    {
        Session::flash('error', __('Oops! Payment Failed.'));
        Session::forget('invest_amount');
        Session::forget('project');
        return to_route('user.invests.create');
    }

    public function success()
    {
        abort_if(!Session::has('payment_info') && !Session::has('payment_type'), 404);
        $amount = Session::get('invest_amount');
        $is_installment = Session::get('is_installment');
        $project = Session::get('project');
        $gateway_id = Session::get('payment_info')['gateway_id'];
        $trx = Session::get('payment_info')['payment_id'];

        if ($is_installment) {
            \DB::beginTransaction();
            try {
                $installment = Installment::whereUserId(auth()->id())->latest()->where('project_id', $project->id)->first();
                $duration = $installment->duration ?? $project->installment->value['installment_duration'];

                $total_installments = $project->installment->value['total_installments'];
                $installment_times = Installment::whereUserId(auth()->id())->where('project_id', $project->id)->count()+1;

                $is_late = !empty($installment) && $installment->next_installment <= today() ? true:false;
                $late_fees = $installment->late_fees ?? $project->installment->value['late_fees'];
                $original_amount = $installment->amount ?? $project->installment->value['installment_amount'];

                Installment::create([
                    'user_id' => auth()->id(),
                    'project_id' => $project->id,
                    'amount' => $original_amount,
                    'duration' => $duration,
                    'late_fees' => $late_fees,
                    'is_late' => $is_late,
                    'next_installment' => $installment_times == $total_installments ? NULL : ($installment ? Carbon::createFromFormat('Y-m-d', $installment->next_installment)->addDays($duration) : Carbon::now()->addDays($duration)),
                ]);

                Transaction::create([
                    'user_id' => auth()->id(),
                    'amount' => $amount,
                    'rate' => default_currency()->rate,
                    'reason' => "Invest installment payment",
                    'name' => auth()->user()->name,
                    'email' => auth()->user()->email,
                ]);

                $total_invest = Installment::whereUserId(auth()->id())->where('project_id', $project->id)->sum('amount');
                if ($installment_times == $total_installments) {
                    $share = ($total_invest * 100) / $project->max_invest_amount;
                    Investment::create([
                        'trx' => Str::uuid(),
                        'share' => $share,
                        'user_id' => auth()->id(),
                        'gateway_id' => 'Invest',
                        'amount' => $total_invest,
                        'project_id' => $project->id,
                        'is_returnable' => 1,
                        'is_installment' => 0,
                    ]);
                }

                \DB::commit();
                return redirect(route('user.installments.log'))->with('success', __("Installment payment successfully."));

            } catch (\Throwable$th) {
                \DB::rollback();
                return response()->json([
                    'message' => __("Something was wrong, Please contact with author."),
                    'redirect' => route('user.installments.log'),
                ], 403);
            }
        } else {
            \DB::beginTransaction();
            try {

                $share = ($amount * 100) / $project->max_invest_amount;
                Investment::create([
                    'trx' => $trx,
                    'share' => $share,
                    'amount' => $amount,
                    'is_returnable' => 1,
                    'user_id' => auth()->id(),
                    'gateway_id' => $gateway_id,
                    'project_id' => $project->id,
                ]);

                Transaction::create([
                    'user_id' => auth()->id(),
                    'currency_id' => default_currency()->id,
                    'amount' => $amount,
                    'rate' => default_currency()->rate,
                    'reason' => "Invest",
                    'name' => auth()->user()->name,
                    'email' => auth()->user()->email,
                ]);

                \DB::commit();
                Session::forget('invest_amount');
                Session::forget('project');

                return to_route('user.invests.index')->with('success', __('Investment successfully.'));
            } catch (Throwable $th) {
                \DB::rollback();
                Session::forget('invest_amount');
                Session::forget('project');
                return response()->json([
                    'message' => __("Something was wrong, Please contact with author."),
                    'redirect' => route('user.invests.index'),
                ], 403);
            }
        }
    }

}
