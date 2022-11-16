<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Gateway;
use App\Models\Project;
use App\Models\Investment;
use App\Models\Installment;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class InstallmentController extends Controller
{
    public function index(Request $request)
    {
        $project = Project::with('installment')->findOrFail($request->id);
        $installment = Installment::whereUserId(auth()->id())->latest()->where('project_id', $request->id)->first();

        if ($project->accept_installments) {
            $data['is_late'] = !empty($installment) && $installment->next_installment <= today() ? true:false;
            $data['late_fees'] = $installment->late_fees ?? $project->installment->value['late_fees'];
            $data['amount'] = $installment->amount ?? $project->installment->value['installment_amount'];
            return response()->json($data);
        }
        return false;
    }

    public function installmentsLog()
    {
        $installments = Installment::whereUserId(auth()->id())->latest()->paginate();
        return view('user.installments.index', compact('installments'));
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

    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|integer',
        ]);

        $invests = Investment::whereUserId(auth()->id())->pluck('project_id')->toArray();
        if (in_array($request->project_id, $invests)) {
            return response()->json([
                'message' => __("Already invest.")
            ], 403);
        }

        $project = Project::with('installment')->findOrFail($request->project_id);
        $installment = Installment::whereUserId(auth()->id())->latest()->where('project_id', $request->project_id)->first();

        if ($project->accept_installments) {
            $is_late = !empty($installment) && $installment->next_installment <= today() ? true:false;
            $late_fees = $installment->late_fees ?? $project->installment->value['late_fees'];
            $amount = $installment->amount ?? $project->installment->value['installment_amount'];
            $main_amount = $is_late ? ($late_fees + $amount):$amount;

            if (!$request->is_wallet) {
                Session::put('invest_amount', $main_amount);
                Session::put('project', $project);
                Session::put('is_installment', true);
                return response()->json([
                    'message' => __('Great! You are redirect to the next step.'),
                    'redirect' => route('user.invests.create'),
                ]);
            }

            $user = auth()->user();
            if ($main_amount <= $user->wallet) {
                \DB::beginTransaction();
                try {

                    $user->update([
                        'wallet' => $user->wallet - $request->amount,
                    ]);

                    $total_installments = $project->installment->value['total_installments'];
                    $installment_times = Installment::whereUserId(auth()->id())->where('project_id', $request->project_id)->count()+1;
                    $duration = $installment->duration ?? $project->installment->value['installment_duration'];
                    $total_invest = Installment::whereUserId(auth()->id())->where('project_id', $request->project_id)->sum('amount');

                    if ($installment_times == $total_installments) {
                        $share = ($amount * 100) / $project->max_invest_amount;
                        Investment::create([
                            'trx' => Str::uuid(),
                            'share' => $share,
                            'user_id' => auth()->id(),
                            'gateway_id' => 'Invest Using Balance',
                            'amount' => $total_invest,
                            'project_id' => $project->id,
                            'is_returnable' => 1,
                            'is_installment' => 0,
                        ]);

                    }

                    Installment::create([
                        'user_id' => auth()->id(),
                        'project_id' => $project->id,
                        'amount' => $amount,
                        'duration' => $duration,
                        'late_fees' => $late_fees,
                        'is_late' => $is_late,
                        'next_installment' => $installment_times == $total_installments ? NULL : ($installment ? Carbon::createFromFormat('Y-m-d', $installment->next_installment)->addDays($duration) : Carbon::now()->addDays($duration)),
                    ]);

                    Transaction::create([
                        'user_id' => auth()->id(),
                        'amount' => $main_amount,
                        'rate' => default_currency()->rate,
                        'reason' => "Invest installment payment",
                        'name' => auth()->user()->name,
                        'email' => auth()->user()->email,
                    ]);

                    \DB::commit();

                    return response()->json([
                        'message' => __("Installment payment successfully."),
                        'redirect' => route('user.installments.log'),
                    ]);

                } catch (\Throwable $th) {
                    \DB::rollback();
                    return response()->json([
                        'message' => __("Something was wrong, Please contact with author."),
                        'redirect' => route('user.installments.log'),
                    ], 403);
                }
            } else {
                return response()->json([
                    'message' => __("You have not sufficient balance. Please deposit or payment directly."),
                ], 403);
            }

        } else {
            return response()->json([
                'message' => __("Installment payment not accepted.")
            ], 403);
        }
    }

}
