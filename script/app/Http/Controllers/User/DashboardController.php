<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Payout;
use App\Models\Deposit;
use App\Models\Investment;
use App\Models\Installment;
use App\Models\Returnschedule;
use App\Models\Returntransaction;
use App\Http\Controllers\Controller;
use Request;

class DashboardController extends Controller
{
    public function index()
    {
        $investments = Investment::whereHas('project.nextschedule')->with('project.nextschedule')->whereUserId(auth()->id())->paginate();
        $installments = Installment::with('project')->whereUserId(auth()->id())->where('next_installment', '>=', today())->paginate();
        return view('user.dashboard.index', compact('installments', 'investments'));
    }

    public function getDashboardData(Request $request)
    {
        $data['total_deposit'] = currency_format(Deposit::whereUserId(auth()->id())->sum('amount'));
        $data['total_withdraw'] = currency_format(Payout::whereUserId(auth()->id())->sum('amount'));
        $data['pending_deposit'] = currency_format(Deposit::whereUserId(auth()->id())->whereStatus(0)->sum('amount'));
        $data['total_earnings'] = currency_format(Returntransaction::whereUserId(auth()->id())->where('amount', '>', 0)->sum('amount'));
        $data['total_loss'] = Returntransaction::whereUserId(auth()->id())->where('amount', '<', 0)->sum('amount').default_currency()->symbol;
        $data['total_invest'] = currency_format(Investment::whereUserId(auth()->id())->sum('amount'));
        $data['current_invest'] = currency_format(Investment::whereUserId(auth()->id())->latest()->limit(1)->sum('amount'));
        $data['pending_withdraw'] = currency_format(Payout::whereStatus(0)->whereUserId(auth()->id())->sum('amount'));

        $data['earnings_loss'] = Returntransaction::whereUserId(auth()->id())
            ->whereYear('created_at', '>=', Carbon::now()->subDays($request->day ?? 7))
            ->selectRaw('month(created_at) month, sum(amount) amount')
            ->groupBy('month')
            ->get()
            ->map(function ($q) use($request) {
                $data['month'] = isset($request->day) && $request->day == 365 ? Carbon::createFromFormat('m', $q->month)->format('F') : Carbon::createFromFormat('m', $q->month)->format('d-m-Y');
                $data['amount'] = number_format($q->amount, 2);
                return $data;
            });

        return response()->json($data);
    }
}
