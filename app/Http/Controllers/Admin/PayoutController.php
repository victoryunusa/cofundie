<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Payout;
use App\Mail\PayoutMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class PayoutController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:payouts-create')->only('create', 'store');
        $this->middleware('permission:payouts-read')->only('index', 'show');
        $this->middleware('permission:payouts-update')->only('edit', 'update');
        $this->middleware('permission:payouts-delete')->only('edit', 'destroy');
    }

    public function index()
    {
        $data['total_payouts'] = Payout::count();
        $data['total_approved'] = Payout::where('status', 'approved')->count();
        $data['total_rejected'] = Payout::where('status', 'rejected')->count();
        $data['total_pending'] = Payout::where('status', 'pending')->count();
        $data['payouts'] = Payout::latest()->with('payout_method')
                    ->when(request('status') == 'approved', function($q) {
                        $q->where('status', 'approved');
                    })
                    ->when(request('status') == 'rejected', function($q) {
                        $q->where('status', 'rejected');
                    })
                    ->when(request('status') == 'pending', function($q) {
                        $q->where('status', 'pending');
                    })
                    ->paginate(10);

        return view('admin.payouts.index', $data);
    }

    public function approved(Request $request)
    {
        $payout = Payout::find($request->payout);
        if ($payout->status == 'rejected') {
            $user = User::find($payout->user_id);
            $user->update([
                'wallet' => $user->wallet - $payout->amount
            ]);
        }

        // Send Email to admin
        if (env('QUEUE_MAIL')) {
            Mail::to(env('MAIL_TO'))->queue(new PayoutMail($payout));
        } else {
            Mail::to(env('MAIL_TO'))->send(new PayoutMail($payout));
        }

        $payout->update([
            'status' => 'approved'
        ]);

        return response()->json([
            'message' => __('Payout approved successfully.'),
            'redirect' => route('admin.payouts.index')
        ]);
    }

    public function reject(Request $request)
    {
        $payout = Payout::find($request->payout);
        $user = User::find($payout->user_id);
        $user->update([
            'wallet' => $user->wallet + $payout->amount
        ]);
        $payout->update([
            'status' => 'rejected'
        ]);

        return response()->json([
            'message' => __('Payout rejected successfully.'),
            'redirect' => route('admin.payouts.index')
        ]);
    }

    public function deleteAll(Request $request)
    {
        if ($request->ids) {
            foreach ($request->ids as $id) {
                $method = Payout::find($id);
                $method->delete();
            }
        } else {
            return response()->json(__('Please select at least one item.'), 404);
        }

        return response()->json([
            'message' => __('Payouts deleted successfully'),
            'redirect' => route('admin.payouts.index'),
        ]);
    }
}
