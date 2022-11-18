<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Option;
use App\Models\Project;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Investment;
use App\Models\Returntransaction;

class PropertyController extends Controller
{
    public function index()
    {
        $projects = Project::with('meta')->latest()->get();
        $headingData = Option::whereLang(current_locale())
            ->whereIn('key', [
                'heading.property',
            ])->get();

        $headings = [];
        foreach ($headingData as $heading) {
            $headings[$heading->key] = $heading->value;
        }
        $data = [
            'headings' => $headings,
            'projects' => $projects,
        ];
        return view('frontend.properties.index', compact('data'));
    }

    public function statistics(Request $request)
    {
        $returns = Returntransaction::latest()->where('project_id', $request->id)
                    ->limit(12)
                    ->get()
                    ->map(function ($q) {
                        $data['date'] = formatted_date($q->created_at);
                        $data['amount'] = $q->amount;
                        return $data;
                    });

        return response()->json($returns);
    }

    public function show($slug)
    {
        $property = Project::with('meta')->where('slug', $slug)->firstOrFail();
        $invest_amount = Investment::where('project_id', $property->id)->sum('amount');
        $available_blnc = $property->max_invest_amount - $invest_amount;
        $faqs = Category::where('key', 'faq')->whereLang(current_locale())->get();
        return view('frontend.properties.show', compact('property', 'faqs', 'available_blnc'));
    }
}
