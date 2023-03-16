<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Frontend\TermController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\SubscribeController;

Route::group([
    'prefix' => 'user',
    'as' => 'user.',
    'namespace' => 'App\Http\Controllers\User',
    'middleware' => ['auth', 'verified', 'user', 'kyc']
], function () {

    Route::get('dashboard', 'DashboardController@index')->name('dashboard.index');
    Route::get('dashboard/datas', 'DashboardController@getDashboardData')->name('get-dashbaord-data');
    Route::get('invests/plans', 'InvestController@plans')->name('invests.plans');
    Route::post('invests/payment', 'InvestController@investPayment')->name('invests.payment');
    Route::get('transactions', 'TransactionsController@index')->name('transactions.index');

    Route::resource('supports', 'SupportController');
    Route::resource('earnings', 'EarningController')->only('index');
    Route::resource('installments', 'InstallmentController')->only('index', 'store');
    Route::get('invests/log', 'InvestController@investmentLogs')->name('investments.log');
    Route::get('installments/log', 'InstallmentController@installmentsLog')->name('installments.log');

    // Investment system
    Route::resource('invests', 'InvestController')->only('index', 'store', 'create');
    Route::post('/invests/make-payment/{gateway}', 'InvestController@makePayment')->name('invests.make-payment');
    Route::get('/invests/payment/success', 'InvestController@success')->name('invests.payment.success');
    Route::get('invests/payment/failed', 'InvestController@failed')->name('invests.payment.failed');

    // Deposit System
    Route::resource('deposits', 'DepositController');
    Route::post('/deposit/make-payment/{gateway}', 'DepositController@makePayment')->name('deposit.make-payment');
    Route::get('/deposit/payment/success', 'DepositController@success')->name('deposit.payment.success');
    Route::get('deposit/payment/failed', 'DepositController@failed')->name('deposit.payment.failed');

    Route::resource('profiles', ProfileController::class)->only('index', 'update');
    Route::get('get-deposits', 'DepositController@getDeposits')->name('get-deposits');
    Route::get('get-transaction', 'TransactionsController@getTransaction')->name('get-transaction');

    //Kyc
    Route::resource('kyc-verifications', 'KycVerificationController')->withoutMiddleware('kyc');
    Route::get('kyc-verifications/{kycRequest}/resubmit', 'KycVerificationController@resubmit')
        ->name('kyc-verifications.resubmit')
        ->withoutMiddleware('kyc');
    Route::put('kyc-verifications/{kycRequest}/resubmit', 'KycVerificationController@resubmitUpdate')
        ->name('kyc-verifications.resubmit.update')
        ->withoutMiddleware('kyc');

    Route::get('payout', 'PayoutController@payout')->name('payout');
    Route::group(['prefix' => 'payout', 'as' => 'payout.'], function () {
            Route::get('/', 'PayoutController@index')->name('index');
            Route::post('checkotp/', 'PayoutController@checkotp')->name('checkotp');
            Route::get('payout/otp/{method_id}', 'PayoutController@otp')->name('otp');
            Route::post('update/{method_id}', 'PayoutController@update')->name('update');
            Route::post('getotp/{method_id}', 'PayoutController@getotp')->name('get-otp');
            Route::post('success/{method_id}', 'PayoutController@success')->name('success');
            Route::get('/payout/setup/{method_id}', 'PayoutController@setup')->name('setup');
            Route::get('/payoutmethod/{method_id}/edit', 'PayoutController@edit')->name('edit');
            Route::get('make-payout/{method_id}', 'PayoutController@makepayout')->name('make-payout');
        }
        );
    });

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'App\Http\Controllers\Admin',
    'middleware' => ['auth', 'verified', 'admin', 'kyc']
], function () {

    Route::get('dashboard', 'DashboardController@index')->name('dashboard.index');
    Route::get('dashboard/datas', 'DashboardController@getDashboardData')->name('get-dashbaord-data');
    Route::get('performance', 'DashboardController@performance')->name('dashboard.performance');
    Route::get('visitors', 'DashboardController@visitors')->name('dashboard.visitors');
    Route::get('get-customers', 'CustomerController@getCustomers')->name('get-customers');
    Route::post('invests/payment', 'InvestController@investPayment')->name('invests.payment');
    Route::get('transactions', 'TransactionController@index')->name('transactions.index');
    Route::get('transactions/{id}', 'TransactionController@show')->name('transactions.show');

    Route::resource('supports', 'SupportController');
    Route::resource('earnings', 'EarningController')->only('index');
    Route::resource('installments', 'InstallmentController')->only('index', 'store');
    Route::get('invests/log', 'InvestController@investmentLogs')->name('investments.log');
    Route::get('installments/log', 'InstallmentController@installmentsLog')->name('installments.log');

    // Investment system
    Route::resource('projects', 'ProjectController')->only('index', 'store', 'create');
    Route::post('/pojects/delete-all/', 'ProjectController@deleteAll')->name('projects.delete-all');
    Route::get('/pojects/show/{id}', 'ProjectController@show')->name('projects.show');
    Route::get('/pojects/edit/{id}', 'ProjectController@edit')->name('projects.edit');
    Route::get('/pojects/update/{id}', 'ProjectController@update')->name('projects.update');

    // Deposit system
    Route::resource('deposits', 'DepositeController')->only('index', 'store', 'create');
    Route::get('/deposits/approve/{id}', 'DepositeController@show')->name('deposits.show');
    Route::get('/deposits/reject/{id}', 'DepositeController@edit')->name('deposits.edit');
    Route::get('/deposits/destroy/{id}', 'DepositeController@destroy')->name('deposits.destroy');


    Route::get('invests/payment/failed', 'InvestController@failed')->name('invests.payment.failed');

    // Return Schedule system
    Route::resource('return-schedules', 'ReturnScheduleController')->only('index', 'store', 'create');
    Route::post('/return-schedules/delete-all/', 'ReturnScheduleController@deleteAll')->name('return-schedules.delete-all');
    Route::get('/return-schedules/show/{id}', 'ReturnScheduleController@show')->name('return-schedules.show');
    Route::get('/return-schedules/edit/{id}', 'ReturnScheduleController@edit')->name('return-schedules.edit');

    Route::resource('media', 'MediaController')->only('index', 'store', 'create');
    Route::post('/media/delete/{id}/', 'MediaController@delete')->name('media.delete');
    Route::get('/media/show/{id}', 'MediaController@show')->name('media.show');
    Route::get('/media/edit/{id}', 'MediaController@edit')->name('media.edit');

    // Deposit System
    // Route::resource('deposits', 'DepositController');
    // Route::post('/deposit/make-payment/{gateway}', 'DepositController@makePayment')->name('deposit.make-payment');
    // Route::get('/deposit/payment/success', 'DepositController@success')->name('deposit.payment.success');
    // Route::get('deposit/payment/failed', 'DepositController@failed')->name('deposit.payment.failed');

    Route::resource('profiles', ProfileController::class)->only('index', 'update');
    Route::get('get-deposits', 'DepositeController@getDeposits')->name('get-deposits');
    Route::get('get-transaction', 'TransactionsController@getTransaction')->name('get-transaction');

    //Kyc
    Route::resource('kyc-verifications', 'KycVerificationController')->withoutMiddleware('kyc');
    Route::get('kyc-verifications/{kycRequest}/resubmit', 'KycVerificationController@resubmit')
        ->name('kyc-verifications.resubmit')
        ->withoutMiddleware('kyc');
    Route::put('kyc-verifications/{kycRequest}/resubmit', 'KycVerificationController@resubmitUpdate')
        ->name('kyc-verifications.resubmit.update')
        ->withoutMiddleware('kyc');

    Route::get('payout', 'PayoutController@payout')->name('payout');
    Route::group(['prefix' => 'payouts', 'as' => 'payouts.'], function () {
            Route::get('/', 'PayoutController@index')->name('index');
            Route::post('checkotp/', 'PayoutController@checkotp')->name('checkotp');
            Route::get('payout/otp/{method_id}', 'PayoutController@otp')->name('otp');
            Route::post('update/{method_id}', 'PayoutController@update')->name('update');
            Route::post('getotp/{method_id}', 'PayoutController@getotp')->name('get-otp');
            Route::post('success/{method_id}', 'PayoutController@success')->name('success');
            Route::post('delete/', 'PayoutController@delete')->name('delete');
            Route::get('/payout/setup/{method_id}', 'PayoutController@setup')->name('setup');
            Route::get('/payoutmethod/{method_id}/edit', 'PayoutController@edit')->name('edit');
            Route::get('make-payout/{method_id}', 'PayoutController@makepayout')->name('make-payout');
        }
        );

        Route::group(['prefix' => 'customers', 'as' => 'customers.'], function () {
            Route::get('/', 'CustomerController@index')->name('index');
            Route::get('/show/{user}', 'CustomerController@show')->name('show');
            Route::get('/edit/{id}', 'CustomerController@edit')->name('edit');
            Route::post('/update/{id}', 'CustomerController@update')->name('update');
            Route::post('/destroy/{id}', 'CustomerController@destroy')->name('destroy');
        }
        );

        Route::group(['prefix' => 'settings', 'as' => 'settings.', 'namespace' => 'Website'], function () {
            Route::get('/website/logo', 'LogoController@index')->name('website.logo.index');
            Route::post('/website/update', 'LogoController@index')->name('website.logo.update');
            Route::get('/show/{user}', 'CustomerController@show')->name('show');
            Route::get('/edit/{id}', 'CustomerController@edit')->name('edit');
            Route::post('/update/{id}', 'CustomerController@update')->name('update');
            Route::post('/destroy/{id}', 'CustomerController@destroy')->name('destroy');
        }
        );
    });

// Payment Related Routes

Route::get('payment/success', [PaymentController::class , 'success'])->name('payment.success');
Route::group([
    'prefix' => 'user',
    'as' => 'user.',
    'middleware' => ['auth'],
    'namespace' => 'App\Lib'
], function () {
    Route::get('/payment/paypal', 'Paypal@status');
    Route::post('/stripe/payment', 'Stripe@status')->name('stripe.payment');
    Route::get('/stripe', 'Stripe@view')->name('stripe.view');
    Route::get('/payment/mollie', 'Mollie@status');
    Route::post('/payment/paystack', 'Paystack@status')->name('paystack.status');
    Route::get('/paystack', 'Paystack@view')->name('paystack.view');
    Route::get('/mercadopago/pay', 'Mercado@status')->name('mercadopago.status');
    Route::get('/razorpay/payment', 'Razorpay@view')->name('razorpay.view');
    Route::post('/razorpay/status', 'Razorpay@status');
    Route::get('/payment/flutterwave', 'Flutterwave@status');
    Route::get('/payment/thawani', 'Thawani@status');
    Route::get('/payment/instamojo', 'Instamojo@status');
    Route::get('/payment/toyyibpay', 'Toyyibpay@status');
    Route::get('/manual/payment', 'CustomGateway@status')->name('manual.payment');
    Route::get('payu/payment', 'Payu@view')->name('payu.view');
    Route::post('/payu/status', 'Payu@status')->name('payu.status');
});


Route::get('properties/{slug}', [PropertyController::class , 'show'])->name('frontend.properties.show');

Route::post('newsletter', [CommonController::class , 'subscribeToNewsLetter'])->name('frontend.subscribe-to-news-letter');

Route::group(['namespace' => 'App\Http\Controllers\Frontend'], function () {
    Route::get('terms', [TermController::class , 'index'])->name('frontend.terms.index');

});