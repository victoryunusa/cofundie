<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Option;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TermController extends Controller
{
    public function index()
    {
        $faqs = Category::where('key', 'faq')->whereLang(current_locale())->get();
        $headingData = Option::whereLang(current_locale())
            ->whereIn('key', [
                'heading.terms',
            ])->get();

        $headings = [];
        foreach ($headingData as $heading) {
            $headings[$heading->key] = $heading->value;
        }
        $data = [
            'faqs' => $faqs,
            'headings' => $headings,
        ];

        return view('frontend.terms.index', compact('data'));
    }
}
