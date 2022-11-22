<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Option;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\SEOTools;
class FaqController extends Controller
{
    public function index()
    {
        $seo = get_option('seo_faq', true);
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
