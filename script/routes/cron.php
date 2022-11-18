<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CronController;

Route::group(['prefix' => 'cron', 'as' => 'cron.'], function (){
    Route::get('invest/profit-loss', [CronController::class, 'profitLoss'])->name('invest.profit-loss');
    Route::get('before-expire-7-days', [CronController::class, 'beforeExpireSevenDay'])->name('before-expire-seven-day');
});
