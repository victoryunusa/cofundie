<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CronController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\Installer\InstallerController;

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
    Route::post('/dismiss-header','HomeController@dismiss');
    Route::post('newsletter-subscribe', '\App\Http\Controllers\CommonController@subscribeToNewsLetter')->name('subscribe-to-news-letter');
});




/*
|--------------------------------------------------------------------------
| Installer Routes
|--------------------------------------------------------------------------
*/
Route::group(['namespace'=>'Installer'],function(){
	Route::get('install',[InstallerController::class,'index'])->name('install');
	Route::get('install/info',[InstallerController::class,'configuration'])->name('install.configuration');
	Route::get('install/verify',[InstallerController::class,'verify'])->name('install.verify');
	Route::post('verify_check',[InstallerController::class,'verify_check'])->name('install.verify_check');
	Route::get('install/complete',[InstallerController::class,'complete'])->name('install.complete');
	Route::post('install/store',[InstallerController::class,'send'])->name('install.store');
	Route::get('install/check',[InstallerController::class,'check'])->name('install.check');
	Route::get('install/migrate',[InstallerController::class,'migrate'])->name('install.migrate');
	Route::get('install/seed',[InstallerController::class,'seed'])->name('install.seed');
    Route::get('404',function(){
        return abort(404);
    });
});
