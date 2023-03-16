<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Term;
use App\Models\Option;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\SEOTools;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        //Set SEO
       

        $seo = get_option('seo_blog', true);
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

        // Main
        $src = $request->get('title');
        $tag = $request->get('tag');

        $headingData = Option::whereLang(current_locale())
            ->whereIn('key', [
                'heading.latest-news',
            ])->get();

        $headings = [];
        foreach ($headingData as $heading) {
            $headings[$heading->key] = $heading->value;
        }
        $data = [
            'headings' => $headings,
        ];

        $posts = Term::whereType('blog')->whereStatus(1)
            ->with('preview', 'description')
            ->when($src !== null, function (Builder $builder) use($src) {
                $builder->where('title', 'LIKE', '%'.$src.'%');
            })
            ->where('status',1)
            ->latest()
            ->paginate(10);

        return view('frontend.blog.index', compact('posts', 'data'));
    }

    public function show($slug)
    {
        $post = Term::with('preview', 'description')->where('status',1)->where('slug', $slug)->firstOrFail();
        SEOMeta::setTitle($post->title);
        SEOMeta::setDescription($post->description->value ?? 'Description');
        SEOMeta::addMeta('article:published_time', $post->created_at->toW3CString(), 'property');
        SEOMeta::addKeyword([$post->title]);

        OpenGraph::setDescription($post->description->value ?? 'Description');
        OpenGraph::setTitle($post->title);

        OpenGraph::addImage(asset($post->preview->value ?? ''));
        OpenGraph::addImage(['url' => asset($post->preview->value ?? ''), 'size' => 300]);
        OpenGraph::addImage(asset($post->preview->value ?? ''), ['height' => 300, 'width' => 300]);

        JsonLd::setTitle($post->title);
        JsonLd::setDescription($post->description->value ?? 'Description');
      

        $recentPosts = Term::whereType('blog')
            ->with('preview', 'description')
            ->latest()->where('status',1)->limit(3)->get();

        return view('frontend.blog.show', compact('recentPosts', 'post'));
    }
}
