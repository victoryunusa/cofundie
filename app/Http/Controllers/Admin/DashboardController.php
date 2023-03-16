<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Installment;
use App\Models\Investment;
use App\Models\Payout;
use App\Models\Project;
use App\Models\Support;
use App\Models\User;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:dashboard-read');
    }

    public function index()
    {
        $data['installments'] = Installment::with('user', 'project')->latest()->limit(10)->get();
        $data['investments'] = Investment::with('user', 'project')->latest()->limit(10)->get();
        $data['supports'] = Support::with('user')->whereStatus(0)->latest()->limit(10)->get();
        $data['deposits'] = Deposit::whereStatus(2)->latest()->limit(10)->get();
        $data['withdraws'] = Payout::with('method')->whereStatus("pending")->latest()->limit(10)->get();
        return view('admin.dashboard', $data);
    }

    public function getDashboardData()
    {
        $total_customers = User::whereRole('user')->count();
        $total_investments = Investment::count();
        $investments_amount = currency_format(Investment::sum('amount'));
        $total_plans = Project::count();
        $active_plans = Project::whereStatus(1)->count();
        $deactiev_plans = Project::whereStatus(0)->count();


        $data['total_customers'] = $total_customers;
        $data['total_investments'] = $total_investments;
        $data['investments_amount'] = $investments_amount;
        $data['total_plans'] = $total_plans;
        $data['active_plans'] = $active_plans;
        $data['deactiev_plans'] = $deactiev_plans;

        return response()->json($data);
    }

    //analtiycs code will append
    public function performance($days)
    {
        // code...
    }
     //analtiycs code will append
    public function visitors($days)
    {
        // code...
    }
}
