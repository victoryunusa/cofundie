<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Returntransaction;
use Illuminate\Http\Request;

class EarningController extends Controller
{
    public function index()
    {
        $earnings = Returntransaction::with('project')->whereUserId(auth()->id())->where('amount', '>', 0)->latest()->paginate(10);
        return view('user.earnings.index', compact('earnings'));
    }
}
