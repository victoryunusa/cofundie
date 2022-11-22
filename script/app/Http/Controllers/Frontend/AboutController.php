<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Option;
use App\Models\Term;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\SEOTools;
class AboutController extends Controller
{
    public function index()
    {
        //Set SEO
     

        $seo = get_option('seo_about', true);
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
