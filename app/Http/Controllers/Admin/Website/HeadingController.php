<?php

namespace App\Http\Controllers\Admin\Website;

use App\Helpers\HasUploader;
use App\Http\Controllers\Controller;
use App\Models\Option;
use Cache;
use Illuminate\Http\Request;

class HeadingController extends Controller
{
    use HasUploader;

    public function __construct()
    {
        $this->middleware('permission:website-read')->only('index');
        $this->middleware('permission:website-update')->except('index');
    }
    public function index()
    {
        $languages = Option::where('key', '=', 'languages')
            ->withCasts(['value' => 'array'])
            ->select(['value'])
            ->first();

        $headingData = Option::whereIn('key', [
            'heading.welcome',
            'heading.feature',
            'heading.smart-investors',
            'heading.investments-count',
            'heading.the-way',
            'heading.how-works',
            'heading.about',
            'heading.your-portfolio',
            'heading.income-history',
            'heading.latest-news',
            'heading.our-assets',
            'heading.faq-questions',
            'heading.faq',
            'heading.contacts',
            'heading.privacy',
            'heading.terms',
            'heading.investments',
            'heading.property',
        ])->get();

        $headings = [];
        foreach ($headingData as $heading) {
            $headings[$heading->key][$heading->lang] = $heading->value;
        }

        return view('admin.settings.website.heading.index', compact('languages', 'headings'));
    }

    public function updateWelcome(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'button1_text' => ['required', 'string'],
            'button1_url' => ['required', 'string'],
            'button2_text' => ['required', 'string'],
            'button2_url' => ['required', 'string'],
            'image' => ['required', 'string'],
            'background_image_1' => ['required', 'string'],
            'background_image_2' => ['required', 'string'],
            'animate_image' => ['nullable', 'string'],
            'lang' => ['required', 'string']
        ]);

        Option::updateOrCreate([
            'key' => 'heading.welcome',
            'lang' => $request->input('lang')
        ], [
            'value' => $validated
        ]);

        \Artisan::call('cache:clear');

        return response()->json(__('Welcome Section Updated'));
    }

    public function updateFeature(Request $request)
    {
        $validated = $request->validate([
            'short_title' => ['required', 'string'],
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'feature_1_icon' => ['required', 'string'],
            'feature_1_bg' => ['nullable', 'string'],
            'feature_1_text' => ['required', 'string'],
            'feature_1_btn_text' => ['required', 'string'],
            'feature_1_btn_url' => ['required', 'string'],
            'feature_2_icon' => ['required', 'string'],
            'feature_2_bg' => ['nullable', 'string'],
            'feature_2_text' => ['required', 'string'],
            'feature_2_btn_text' => ['required', 'string'],
            'feature_2_btn_url' => ['required', 'string'],
            'feature_3_icon' => ['required', 'string'],
            'feature_3_bg' => ['nullable', 'string'],
            'feature_3_text' => ['required', 'string'],
            'feature_3_btn_text' => ['required', 'string'],
            'feature_3_btn_url' => ['required', 'string'],
            'feature_1_description' => ['required', 'string'],
            'feature_2_description' => ['required', 'string'],
            'feature_3_description' => ['required', 'string'],
        ]);

        Option::updateOrCreate([
            'key' => 'heading.feature',
            'lang' => $request->input('lang')
        ], [
            'value' => $validated
        ]);
        \Artisan::call('cache:clear');

        return response()->json(__('Explore By Cities Section Updated'));
    }

    public function updateSmartInvestors(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string'],
            'suggestions' => ['required', 'string'],
            'image' => ['required', 'string'],
            'description' => ['required', 'string'],
            'btn_text' => ['required', 'string'],
            'btn_link' => ['required', 'string'],
        ]);

        Option::updateOrCreate([
            'key' => 'heading.smart-investors',
            'lang' => $request->input('lang')
        ], [
            'value' => $validated
        ]);

        \Artisan::call('cache:clear');

        return response()->json(__('Smart Investors Section Updated'));
    }

    public function updateInvestmentsCount(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string'],
            'short_title' => ['required', 'string'],
            'background' => ['required', 'string'],
            'description' => ['required', 'string'],
            'feature_1_counter' => ['required', 'string'],
            'feature_1_text' => ['required', 'string'],
            'feature_2_counter' => ['required', 'string'],
            'feature_2_text' => ['required', 'string'],
            'feature_3_counter' => ['required', 'string'],
            'feature_3_text' => ['required', 'string'],
        ]);

        Option::updateOrCreate([
            'key' => 'heading.investments-count',
            'lang' => $request->input('lang')
        ], [
            'value' => $validated
        ]);

        \Artisan::call('cache:clear');

        return response()->json(__('Count All Investments Section Updated'));
    }

    public function updateTheWay(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string'],
            'image' => ['required', 'string'],
            'button1_text' => ['required', 'string'],
            'button1_url' => ['required', 'string'],
            'button2_text' => ['required', 'string'],
            'button2_url' => ['required', 'string'],
            'short_description' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);

        Option::updateOrCreate([
            'key' => 'heading.the-way',
            'lang' => $request->input('lang')
        ], [
            'value' => $validated
        ]);

        \Artisan::call('cache:clear');

        return response()->json(__("We're Changing The Way Section Updated"));
    }

    public function updateIncomeHistory(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string'],
            'image' => ['required', 'string'],
            'short_title' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);

        Option::updateOrCreate([
            'key' => 'heading.income-history',
            'lang' => $request->input('lang')
        ], [
            'value' => $validated
        ]);

        \Artisan::call('cache:clear');

        return response()->json(__("Income History Section Updated"));
    }

    public function updateLatestNews(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string'],
            'short_title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'page_title' => ['required', 'string'],
            'page_description' => ['required', 'string'],
        ]);

        Option::updateOrCreate([
            'key' => 'heading.latest-news',
            'lang' => $request->input('lang')
        ], [
            'value' => $validated
        ]);

        \Artisan::call('cache:clear');

        return response()->json(__('Latest News & Blog Section Updated'));
    }

    public function updateContacts(Request $request)
    {
        $validated = $request->validate([
            'page_title' => ['required', 'string'],
            'page_description' => ['required', 'string'],
            'short_title' => ['required', 'string'],
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'phone_icon' => ['required', 'string'],
            'phone_title' => ['required', 'string'],
            'phone_number' => ['required', 'string'],
            'phone_description' => ['required', 'string'],
            'email_icon' => ['required', 'string'],
            'email_title' => ['required', 'string'],
            'email_number' => ['required', 'string'],
            'email_description' => ['required', 'string'],
        ]);

        Option::updateOrCreate([
            'key' => 'heading.contacts',
            'lang' => $request->input('lang')
        ], [
            'value' => $validated
        ]);

        \Artisan::call('cache:clear');

        return response()->json(__('Contacts Section Updated'));
    }

    public function updateAbout(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);

        Option::updateOrCreate([
            'key' => 'heading.about',
            'lang' => $request->input('lang')
        ], [
            'value' => $validated
        ]);

        \Artisan::call('cache:clear');

        return response()->json(__('About Us Section Updated'));
    }

    public function updateProperty(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string'],
            'short_title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'page_title' => ['required', 'string'],
            'page_description' => ['required', 'string'],
        ]);

        Option::updateOrCreate([
            'key' => 'heading.property',
            'lang' => $request->input('lang')
        ], [
            'value' => $validated
        ]);

        \Artisan::call('cache:clear');

        return response()->json(__('Property Section Updated'));
    }

    public function updateHowWorks(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);

        Option::updateOrCreate([
            'key' => 'heading.how-works',
            'lang' => $request->input('lang')
        ], [
            'value' => $validated
        ]);

        \Artisan::call('cache:clear');

        return response()->json(__('How Works Section Updated'));
    }

    public function updateYourPortfolio(Request $request)
    {
        $validated = $request->validate([
            'image' => ['required', 'string'],
            'title' => ['required', 'string'],
            'short_title' => ['required', 'string'],
            'suggestions' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);

        Option::updateOrCreate([
            'key' => 'heading.your-portfolio',
            'lang' => $request->input('lang')
        ], [
            'value' => $validated
        ]);

        \Artisan::call('cache:clear');

        return response()->json(__('Your Portfolio Section Updated'));
    }

    public function updateOurAssets(Request $request)
    {
        $validated = $request->validate([
            'short_title' => ['required', 'string'],
            'title' => ['required', 'string'],
            'suggestions' => ['required', 'string'],
            'animate_image' => ['nullable', 'string'],
            'description' => ['required', 'string'],
        ]);

        Option::updateOrCreate([
            'key' => 'heading.our-assets',
            'lang' => $request->input('lang')
        ], [
            'value' => $validated
        ]);

        \Artisan::call('cache:clear');

        return response()->json(__('Your Returns Section Updated'));
    }

    public function updateFaq(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);

        Option::updateOrCreate([
            'key' => 'heading.faq',
            'lang' => $request->input('lang')
        ], [
            'value' => $validated
        ]);

        \Artisan::call('cache:clear');

        return response()->json(__('Faq Area Section Updated'));
    }

    public function updateFaqQuestions(Request $request)
    {
        $validated = $request->validate([
            'short_title' => ['required', 'string'],
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);

        Option::updateOrCreate([
            'key' => 'heading.faq-questions',
            'lang' => $request->input('lang')
        ], [
            'value' => $validated
        ]);

        \Artisan::call('cache:clear');

        return response()->json(__('Faq Questions Area Section Updated'));
    }

    public function updatePrivacy(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'contents' => ['required', 'string'],
        ]);

        Option::updateOrCreate([
            'key' => 'heading.privacy',
            'lang' => $request->input('lang')
        ], [
            'value' => $validated
        ]);

        \Artisan::call('cache:clear');

        return response()->json(__('Privacy & Policy Section Updated'));
    }

    public function updateTerms(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'contents' => ['required', 'string'],
        ]);

        Option::updateOrCreate([
            'key' => 'heading.terms',
            'lang' => $request->input('lang')
        ], [
            'value' => $validated
        ]);

        \Artisan::call('cache:clear');

        return response()->json(__('Terms & Condition Section Updated'));
    }

    public function updateInvestment(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string'],
            'feature_1' => ['required', 'string'],
            'feature_2' => ['required', 'string'],
            'feature_3' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);

        Option::updateOrCreate([
            'key' => 'heading.investments',
            'lang' => $request->input('lang')
        ], [
            'value' => $validated
        ]);

        \Artisan::call('cache:clear');

        return response()->json(__('Investment Section Updated'));
    }
}
