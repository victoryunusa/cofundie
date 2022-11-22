<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Option;
use App\Models\Project;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Investment;
use App\Models\Returntransaction;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\SEOTools;
class PropertyController extends Controller
{
    public function index()
    {
       

        $seo = get_option('seo_properties', true);
        $logo = get_option('logo_setting',true)->logo ?? 'uploads/logo.png';

        JsonLdMulti::setTitle($seo->site_name ?? env('APP_NAME'));
        JsonLdMulti::setDescription($seo->matadescription ?? null);
        JsonLdMulti::addImage(asset($logo));

        SEOMeta::setTitle($seo->site_name ?? env('APP_NAME'));
        SEOMeta::setDescription($seo->matadescription ?? null);
        SEOMeta::addKeyword($seo->tags ?? null);

        SEOTools::setTitle($seo->site_name ?? env('APP_NAME'));
        SEOTools::setDescription($seo->matadescription ?? null);
        
        SEOTools::opengraph()->addProperty('keywords', $seo->matatag ?? null);
        SEOTools::opengraph()->addProperty('image', asset($logo));
        SEOTools::twitter()->setTitle($seo->site_name ?? env('APP_NAME'));
        SEOTools::twitter()->setSite($seo->twitter_site_title ?? null);
        SEOTools::jsonLd()->addImage(asset($logo));

        $projects = Project::with('meta')->where('status',1)->latest()->paginate(20);
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
        return view('frontend.properties.index', compact('data','projects'));
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
        $property = Project::with('meta')->where('status',1)->where('slug', $slug)->firstOrFail();
        $invest_amount = Investment::where('project_id', $property->id)->sum('amount');
        $available_blnc = $property->max_invest_amount - $invest_amount;
        $faqs = Category::where('key', 'faq')->whereLang(current_locale())->get();

        $description=$property->meta->value['description'] ?? '';
        $logo=$property->thumbnail ?? '';


        JsonLdMulti::setTitle($property->title ?? env('APP_NAME'));
        JsonLdMulti::setDescription($description);
        JsonLdMulti::addImage(asset($logo));

        SEOMeta::setTitle($property->title ?? env('APP_NAME'));
        SEOMeta::setDescription($description);
        
        SEOTools::setTitle($property->title ?? env('APP_NAME'));
        SEOTools::setDescription($description);
                
        SEOTools::opengraph()->addProperty('image', asset($logo));
        SEOTools::twitter()->setTitle($property->title ?? env('APP_NAME'));
      
        SEOTools::jsonLd()->addImage(asset($logo));

        return view('frontend.properties.show', compact('property', 'faqs', 'available_blnc'));
    }
}
