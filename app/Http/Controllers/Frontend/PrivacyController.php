<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Option;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PrivacyController extends Controller
{
    public function index()
    {
        $headingData = Option::whereLang(current_locale())
            ->whereIn('key', [
                'heading.privacy',
            ])->get();

        $headings = [];
        foreach ($headingData as $heading) {
            $headings[$heading->key] = $heading->value;
        }
        $data = [
            'headings' => $headings,
        ];

        return view('frontend.privacy.index', compact('data'));
    }
}
