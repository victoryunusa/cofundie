<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CronController;
use App\Http\Controllers\CommonController;

Auth::routes(['verify' => true]);
Route::get('temp-episode/{episode}', [CommonController::class, 'tempEpisode'])->name('temp-episode');
Route::get('local/temp/{path}', [CommonController::class, 'downloadFromTempUrl'])->name('local.temp');


Route::group(['as' => 'frontend.', 'namespace' => 'App\Http\Controllers\Frontend'], function (){
    Route::get('/statistics', 'PropertyController@statistics');
    Route::resource('properties', 'PropertyController')->only('index', 'show');
    Route::get('/', 'HomeController@index')->name('index');
    Route::get('/page/{slug}', 'HomeController@page')->name('page.index');
    Route::get('/about', 'AboutController@index')->name('about.index');
    Route::get('/how-works', 'HowWorksController@index')->name('how-works.index');
    Route::get('/faqs', 'FaqController@index')->name('faqs.index');
    Route::get('/privacy', 'PrivacyController@index')->name('privacy.index');
    Route::get('/terms', 'TermController@index')->name('terms.index');
    Route::get('/invest', 'InvestController@index')->name('invest.index');
    Route::get('/blogs', 'BlogController@index')->name('blogs.index');
    Route::get('/blogs/{slug}', 'BlogController@show')->name('blogs.show');
    Route::get('/contacts', 'ContactController@index')->name('contacts.index');
    Route::post('/contacts', 'ContactController@store')->name('contacts.store');

    Route::post('newsletter-subscribe', '\App\Http\Controllers\CommonController@subscribeToNewsLetter')->name('subscribe-to-news-letter');
});

//Cron jobs
Route::group(['prefix' => 'cron', 'as' => 'cron.'], function (){
    Route::get('invest/profit-loss', [CronController::class, 'profitLoss'])->name('invest.profit-loss');
    Route::get('before-expire-7-days', [CronController::class, 'beforeExpireSevenDay'])->name('before-expire-seven-day');
});
