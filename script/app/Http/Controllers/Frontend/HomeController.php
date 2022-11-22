<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Term;
use App\Models\Option;
use App\Models\Project;
use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\SEOTools;
use DB;
use Session;
class HomeController extends Controller
{
    public function index()
    {
        try {
            DB::connection()->getPdo();
                if(DB::connection()->getDatabaseName()){

                }else{
                return redirect()->route('install');
                }
        } catch (\Exception $e) {
            return redirect()->route('install');
        }
        //Set SEO
      

        $seo = get_option('seo_home', true);
        $logo = get_option('logo_setting',true)->logo ?? 'uploads/logo.png';

        JsonLdMulti::setTitle($seo->site_name ?? env('APP_NAME'));
        JsonLdMulti::setDescription($seo->matadescription ?? null);
        JsonLdMulti::addImage(asset($logo));

        SEOMeta::setTitle($seo->site_name ?? env('APP_NAME'));
        SEOMeta::setDescription($seo->matadescription ?? null);
        SEOMeta::addKeyword($seo->tags ?? null);

        SEOTools::setTitle($seo->site_name ?? env('APP_NAME'));
        SEOTools::setDescription($seo->matadescription ?? null);
        SEOTools::setCanonical(url('/'));
        SEOTools::opengraph()->addProperty('keywords', $seo->matatag ?? null);
        SEOTools::opengraph()->addProperty('image', asset($logo));
        SEOTools::twitter()->setTitle($seo->site_name ?? env('APP_NAME'));
        SEOTools::twitter()->setSite($seo->twitter_site_title ?? null);
        SEOTools::jsonLd()->addImage(asset($logo));

        $data = cache_remember('website.heading.'.current_locale(), function () {
            $headingData = Option::whereLang(current_locale())
                ->whereIn('key', [
                    'heading.welcome',
                    'heading.feature',
                    'heading.smart-investors',
                    'heading.investments-count',
                    'heading.the-way',
                    'heading.income-history',
                    'heading.latest-news',
                    'heading.property',
                ])->get();

            $headings = [];
            foreach ($headingData as $heading) {
                $headings[$heading->key] = $heading->value;
            }

            $posts = Term::with('description', 'preview')->whereType('blog')->latest()->limit(3)->get();
            $projects = Project::with('meta')->latest()->limit(6)->get();

            return [
                'headings' => $headings,
                'posts' => $posts,
                'projects' => $projects,
            ];
        });

        return view('frontend.index', [
            'data' => $data,
        ]);
    }

    public function dismiss()
    {
        Session::put('dismiss_header',true);

        return response(__('Header Notification Bar Removed...!!'));
    }

    public function page($slug)
    {
        $page = Term::where([
            ['type', 'page'],
            ['slug', $slug],
            ['status', 1],
        ])->with('page')->firstOrFail();

        $seo = get_option('seo_home', true);
        $logo = get_option('logo_setting',true)->logo ?? 'uploads/logo.png';
        $meta=json_decode($page->page->value ?? '');

        JsonLdMulti::setTitle($page->title ?? env('APP_NAME'));
        JsonLdMulti::setDescription($meta->metadescription ?? null);
        JsonLdMulti::addImage(asset($logo));

        SEOMeta::setTitle($page->title ?? env('APP_NAME'));
        SEOMeta::setDescription($meta->metadescription ?? null);
        SEOMeta::addKeyword($meta->metatag ?? null);

        SEOTools::setTitle($page->title ?? env('APP_NAME'));
        SEOTools::setDescription($meta->matadescription ?? null);
        SEOTools::setCanonical(url('/'));
        SEOTools::opengraph()->addProperty('keywords', $meta->metatag ?? null);
        SEOTools::opengraph()->addProperty('image', asset($logo));
        SEOTools::twitter()->setTitle($page->titlee ?? env('APP_NAME'));
       
        SEOTools::jsonLd()->addImage(asset($logo));

        return view('frontend.page.index', compact('page'));
    }
}
