<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Option;
use App\Models\Term;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $headingData = Option::whereLang(current_locale())
            ->whereIn('key', [
                'heading.about',
                'heading.feature',
                'heading.the-way',
                'heading.smart-investors',
            ])->get();

        $headings = [];
        foreach ($headingData as $heading) {
            $headings[$heading->key] = $heading->value;
        }
        $data = [
            'headings' => $headings,
        ];

        return view('frontend.about.index', compact('data'));
    }
}
