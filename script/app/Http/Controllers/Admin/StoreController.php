<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Storefront;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:stores-read')->only('index', 'show');
    }
    public function index()
    {
        $stores = Storefront::latest()
                    ->when(request()->search, function($q) {
                        $q->where('name', 'like', '%' . request('search') . '%');
                    })
                    ->paginate();
        return view('admin.stores.index', compact('stores'));
    }

    public function getStores()
    {
        $data['total'] = Storefront::count();
        $data['physical'] = Storefront::whereProductType(0)->count();
        $data['digital'] = Storefront::whereProductType(1)->count();
        return response()->json($data);
    }
}
