<?php

namespace App\Http\Controllers\User;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class TransactionsController extends Controller
{
    public function index(Request $request, $type = null)
    {
        $search = $request->get('search');

            $transactions = Transaction::with('currency')->whereUserId(\Auth::id())
                ->when(!is_null($search), function (Builder $builder) use ($search){
                    $builder->where('name', 'LIKE', '%'.$search.'%')
                        ->orWhere('email', 'LIKE', '%'.$search.'%');
                })
                ->latest()
                ->paginate();

        return view('user.transactions.index', compact('transactions'));
    }

    public function getTransaction()
    {
        $data['total'] = Transaction::whereUserId(auth()->id())->count();
        $data['credit'] = Transaction::whereUserId(auth()->id())->whereType('credit')->count();
        $data['debit'] = Transaction::whereUserId(auth()->id())->whereType('debit')->count();
        return response()->json($data);
    }
}
