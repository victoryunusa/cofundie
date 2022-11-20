<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Term;
use App\Models\Option;
use App\Models\Project;
use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use DB;

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
        $seoOption = get_option('seo_home', true);

        SEOMeta::setTitle($seoOption->site_name ?? null, false);
        SEOMeta::setDescription($seoOption->metadescription ?? null);
        SEOMeta::addKeyword(str($seoOption->metatag ?? null)->explode(',')->toArray());
        SEOTools::twitter()->setSite($seoOption->twitter_site_title ?? null);

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

    public function page($slug)
    {
        $page = Term::where([
            ['type', 'page'],
            ['slug', $slug],
            ['status', 1],
        ])->firstOrFail();

        return view('frontend.page.index', compact('page'));
    }
}
