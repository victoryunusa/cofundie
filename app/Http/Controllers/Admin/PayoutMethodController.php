<?php

namespace App\Http\Controllers\Admin;

use App\Models\PayoutMethod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PayoutMethodController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:payouts-method-create')->only('create', 'store');
        $this->middleware('permission:payouts-method-read')->only('index', 'show');
        $this->middleware('permission:payouts-method-update')->only('edit', 'update');
        $this->middleware('permission:payouts-method-delete')->only('edit', 'destroy');
    }

    public function index()
    {
        $methods = PayoutMethod::latest()->paginate(20);
        return view('admin.payout-methods.index', compact('methods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.payout-methods.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'rate' => ['required', 'numeric', 'gt:0'],
            'delay' => ['required', 'numeric'],
            'currency' => ['required', 'string'],
            'min_limit' => ['required', 'gt:0'],
            'max_limit' => ['required', 'after_or_equal:min_limit'],
            'fixed_charge' => ['nullable', 'gt:0'],
            'percent_charge' => ['nullable', 'between:0,100'],
            'instruction' => ['required', 'string'],
            'charge_type' => ['required', 'in:fixed,percentage'],
        ]);

        if($request->charge_type == 'fixed')
        {
            $request->validate([
                'fixed_charge' => ['required', 'gt:0'],
            ]);
        }

        if($request->charge_type == 'percentage')
        {
            $request->validate([
                'percent_charge' => ['required', 'between:0,100'],
            ]);
        }

        $data = json_encode($request->inputs);
        PayoutMethod::create($request->all() + [
            'image' => $request->preview,
            'data' => $data
        ]);
        return response()->json([
            'message' => __('Payout method created successfully')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PayoutMethod  $Payoutmethod
     * @return \Illuminate\Http\Response
     */
    public function show(PayoutMethod $payoutmethod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PayoutMethod  $Payoutmethod
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payoutmethod = PayoutMethod::find($id);
        return view('admin.payout-methods.edit', compact('payoutmethod'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PayoutMethod  $Payoutmethod
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'rate' => ['required', 'numeric', 'gt:0'],
            'delay' => ['required', 'numeric'],
            'currency' => ['required', 'string'],
            'min_limit' => ['required', 'gt:0'],
            'max_limit' => ['required', 'after_or_equal:min_limit'],
            'fixed_charge' => ['nullable', 'gt:0'],
            'percent_charge' => ['nullable', 'between:0,100'],
            'instruction' => ['required', 'string'],
        ]);

        $data = json_encode($request->inputs) ?? null;
        $method = PayoutMethod::find($id);
        $method->update($request->all() + [
            'image' => $request->preview,
            'data' => $data
        ]);

        return response()->json(__('Payout method updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PayoutMethod  $Payoutmethod
     * @return \Illuminate\Http\Response
     */
    public function destroy(PayoutMethod $payoutmethod)
    {
        //
    }

    public function deleteAll(Request $request)
    {

        if ($request->ids) {
            foreach ($request->ids as $id) {
                $method = PayoutMethod::find($id);
                if (file_exists($method->image)) {
                    Storage::delete($method->image);
                }
                $method->delete();
            }
        } else {
            return response()->json(__('Please select at least one item.'), 404);
        }
        return response()->json([
            'message' => __('Payout methods deleted successfully'),
            'redirect' => route('admin.payout-methods.index'),
        ]);
    }
}
