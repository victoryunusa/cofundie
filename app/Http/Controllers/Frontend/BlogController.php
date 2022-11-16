<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Term;
use App\Models\Option;
// use Artesaos\SEOTools\Facades\SEOMeta;
// use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\OpenGraph;
use Illuminate\Database\Eloquent\Builder;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        //Set SEO
        $seoOption = get_option('seo_blog', true);

        SEOMeta::setTitle($seoOption->site_name ?? null, false);
        SEOMeta::setDescription($seoOption->matadescription ?? null);
        SEOMeta::addKeyword(str($seoOption->metatag ?? null)->explode(',')->toArray());
        SEOTools::twitter()->setSite($seoOption->twitter_site_title ?? null);

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
            ->latest()
            ->paginate(10);

        return view('frontend.blog.index', compact('posts', 'data'));
    }

    public function show($slug)
    {
        $post = Term::with('preview', 'description')->where('slug', $slug)->firstOrFail();
        SEOMeta::setTitle($post->title);
        SEOMeta::setDescription($post->description->value ?? 'Description');
        SEOMeta::addMeta('article:published_time', $post->created_at->toW3CString(), 'property');
        SEOMeta::addKeyword([$post->title]);

        OpenGraph::setDescription($post->description->value ?? 'Description');
        OpenGraph::setTitle($post->title);

        OpenGraph::addImage($post->preview->value ?? 'test');
        OpenGraph::addImage(['url' => $post->preview->value ?? 'http://image.url.com/cover.jpg', 'size' => 300]);
        OpenGraph::addImage($post->preview->value ?? 'http://image.url.com/cover.jpg', ['height' => 300, 'width' => 300]);

        JsonLd::setTitle($post->title);
        JsonLd::setDescription($post->description->value ?? 'Description');
        JsonLd::setType('Article');

        $recentPosts = Term::whereType('blog')
            ->with('preview', 'description')
            ->latest()->limit(3)->get();

        return view('frontend.blog.show', compact('recentPosts', 'post'));
    }
}
