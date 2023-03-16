<?php

namespace App\Http\Controllers\Admin;

use App\Models\Deposit;
use App\Models\Investment;
use App\Models\Installment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Returntransaction;
use Illuminate\Database\Eloquent\Builder;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:reports-read');
    }

    public function investments()
    {
        $investments = Investment::with('user', 'project','gateway')->latest()->paginate();
        return view('admin.investments.index', compact('investments'));
    }

    public function installments()
    {
        $installments = Installment::with('user', 'project')->latest()->paginate();
        return view('admin.installments.index', compact('installments'));
    }

    public function returnTransactions()
    {
        $returns = Returntransaction::with('user', 'project')->latest()->paginate();
        return view('admin.return-transactions.index', compact('returns'));
    }

}
