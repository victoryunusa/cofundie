<?php

namespace App\Http\Controllers\Frontend;

use App\Rules\Phone;
use App\Models\Option;
use App\Models\ContactMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\SendContactMailToAdmin;
use Illuminate\Support\Facades\Mail;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\SEOTools;
class ContactController extends Controller
{
    public function index()
    {
        $seo = get_option('seo_contact', true);
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
                'heading.contacts',
            ])->get();

        $headings = [];
        foreach ($headingData as $heading) {
            $headings[$heading->key] = $heading->value;
        }
        $data = [
            'headings' => $headings,
        ];

        return view('frontend.contact.index', compact('data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        $mail = ContactMail::create($validated);

        if (config('system.queue.mail')){
            Mail::to(env('MAIL_TO'))->queue(new SendContactMailToAdmin($mail));
        }else{
            Mail::to(env('MAIL_TO'))->send(new SendContactMailToAdmin($mail));
        }

        return response()->json([
            'message' => __('Contact Mail Successfully Sent')
        ]);
    }
}
