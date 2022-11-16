<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Option;
use App\Http\Controllers\Controller;
use App\Models\Category;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Category::where('key', 'faq')->whereLang(current_locale())->get();
        $headingData = Option::whereLang(current_locale())
            ->whereIn('key', [
                'heading.faq',
                'heading.faq-questions',
            ])->get();

        $headings = [];
        foreach ($headingData as $heading) {
            $headings[$heading->key] = $heading->value;
        }
        $data = [
            'faqs' => $faqs,
            'headings' => $headings,
        ];

        return view('frontend.faqs.index', compact('data'));
    }
}
