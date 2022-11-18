<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use App\Models\Option;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:website-read')->only('index');
        $this->middleware('permission:website-update')->only('update');
    }

    public function index()
    {
        $announcements = Option::where('key', 'announcements')->first();
        return view('admin.settings.website.announcements', compact('announcements'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'status' => 'required|string',
            'button_name_1' => 'nullable|string',
            'button_link_1' => 'nullable|string|url',
            'button_name_2' => 'nullable|string',
            'button_link_2' => 'nullable|string|url',
            'button_name_3' => 'nullable|string',
            'button_link_3' => 'nullable|string|url',
        ]);

        Option::updateOrCreate([
            'key' => 'announcements',
            'lang' => $request->input('lang') ?? 'en'
        ], [
            'value' => $validated
        ]);

        \Cache::forget('announcements');

        return response()->json([
            'message' => __('Announcements Updated Successfully')
        ]);
    }
}
