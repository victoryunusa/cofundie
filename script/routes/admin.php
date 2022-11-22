<?php
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'App\Http\Controllers\Admin', 'middleware' => ['auth', 'admin']], function () {

    Route::get('dashboard', 'DashboardController@index')->name('dashboard.index');
    Route::get('dashboard/datas', 'DashboardController@getDashboardData')->name('get-dashbaord-data');

    // Website
    Route::resource('customers', 'CustomerController')->except('create', 'store');
    Route::get('get-customers', 'CustomerController@getCustomers')->name('get-customers');

    Route::resource('blog', 'BlogController');
    Route::resource('page', 'PageController');
    Route::resource('plans', 'PlanController');
    Route::resource('staff', 'StaffController');
    Route::resource('projects', 'ProjectController');
    Route::resource('{project_id}/return-schedules', 'ReturnScheduleController');
    Route::post('projects/delete-all',  'ProjectController@deleteAll')->name('projects.delete-all');
    Route::resource('payment-gateways', 'PaymentGatewayController')->except('show');
    Route::get('pages/choose/{lang}', 'PageController@choose')->name('page.choose');
    Route::resource('subscribers', 'SubscriberController')->only('index', 'destroy');
    Route::post('blog/delete-all',  'BlogController@deleteAll')->name('blog.delete-all');
    Route::post('page/delete-all',  'PageController@deleteAll')->name('page.delete-all');
    Route::delete('subscribers/{email}/unsubscribe', 'SubscriberController@unsubscribe')->name('subscribers.unsubscribe');

    // Reports
    Route::get('transactions', 'TransactionController@index')->name('transactions.index');
    Route::get('transactions/{transaction}', 'TransactionController@show')->name('transactions.show');
    Route::get('get-transaction', 'TransactionController@getTransaction')->name('get-transaction');
    Route::get('investments', 'ReportController@investments')->name('investments.index');
    Route::get('installments', 'ReportController@installments')->name('installments.index');
    Route::get('return-transactions', 'ReportController@returnTransactions')->name('return-transactions.index');

    // Deposits
    Route::resource('deposits', 'DepositeController')->only('index', 'show', 'destroy');
    Route::get('get-deposits', 'DepositeController@getDeposits')->name('get-deposits');
    Route::get('deposit/approve/{id}', 'DepositeController@approve')->name('deposits.approve');
    Route::get('deposit/reject/{id}', 'DepositeController@reject')->name('deposits.reject');

    // Payouts
    Route::resource('payout-methods', 'PayoutMethodController');
    Route::post('payout-methods/delete-all', 'PayoutMethodController@deleteAll')->name('payout-methods.delete');
    Route::post('payouts/delete-all', 'PayoutController@deleteAll')->name('payouts.delete');
    Route::get('payouts/approved', 'PayoutController@approved')->name('payouts.approved');
    Route::get('payouts/reject', 'PayoutController@reject')->name('payouts.reject');
    Route::resource('payouts', 'PayoutController')->only('index');
    Route::get('payouts/{id}', 'PayoutController@show')->name('payouts.show');
    
  

    // KYC
    Route::post('/kyc-method/mass-destroy','KycMethodController@massDestroy')->name('kyc-method.mass-destroy');
    Route::resource('kyc-method','KycMethodController');
    Route::post('kyc-requests/destroy/mass',  'KycRequestController@destroyMass')->name('kyc-requests.destroy.mass');
    Route::post('users/kyc-verified/{user}', 'KycRequestController@kycVerified')->name('kyc-requests.kyc-verified');
    Route::resource('kyc-requests', 'KycRequestController')->except('edit', 'update');

    //Supports
    Route::post('supports/get-ticket', 'SupportController@getSupport')->name('supports.get-ticket');
    Route::post('supports/update-status', 'SupportController@updateStatus')->name('supports.update-status');
    Route::post('supports/reply/{support}', 'SupportController@reply')->name('supports.reply');
    Route::resource('supports', 'SupportController');

    //Settings

    Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
        Route::group(['prefix' => 'website', 'as' => 'website.', 'namespace' => 'Website'], function () {
            Route::group(['prefix' => 'heading', 'as' => 'heading.'], function () {
                Route::controller('HeadingController')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::put('update-welcome', 'updateWelcome')->name('update-welcome');
                    Route::put('update-feature', 'updateFeature')->name('update-feature');
                    Route::put('smart-investors', 'updateSmartInvestors')->name('smart-investors');
                    Route::put('investments-count', 'updateInvestmentsCount')->name('investments-count');
                    Route::put('update-the-way', 'updateTheWay')->name('update-the-way');
                    Route::put('update-income-history', 'updateIncomeHistory')->name('update-income-history');
                    Route::put('update-about', 'updateAbout')->name('update-about');
                    Route::put('update-property', 'updateProperty')->name('update-property');
                    Route::put('update-how-works', 'updateHowWorks')->name('update-how-works');
                    Route::put('update-faq', 'updateFaq')->name('update-faq');
                    Route::put('update-faq-questions', 'updateFaqQuestions')->name('update-faq-questions');
                    Route::put('update-privacy', 'updatePrivacy')->name('update-privacy');
                    Route::put('update-terms', 'updateTerms')->name('update-terms');
                    Route::put('update-investments', 'updateInvestment')->name('update-investments');
                    Route::put('update-contacts', 'updateContacts')->name('update-contacts');
                    Route::put('update-your-portfolio', 'updateYourPortfolio')->name('update-your-portfolio');
                    Route::put('update-our-assets', 'updateOurAssets')->name('update-our-assets');
                    Route::put('update-latest-news', 'updateLatestNews')->name('update-latest-news');
                    Route::put('update-contact', 'updateContact')->name('update-contact');
                });
            });
            Route::get('logo', 'LogoController@index')->name('logo.index');
            Route::put('logo', 'LogoController@update')->name('logo.update');
            Route::get('footer', 'FooterController@index')->name('footer.index');
            Route::post('footer/store', 'FooterController@store')->name('footer.store');

            Route::resource('faq', 'FAQController')->except('show');
            Route::resource('announcements', 'AnnouncementController')->only('index', 'update');
        });
    });

    // System
    Route::get('settings', 'AdminController@settings')->name('settings');
    Route::post('currencies/sync', 'CurrencyController@sync')->name('currencies.sync');
    Route::put('currencies/default/{currency}', 'CurrencyController@makeDefault')->name('currencies.make.default');
    Route::resource('currencies', 'CurrencyController');
    Route::post('update-general', 'AdminController@updateGeneral')->name('update-general');
    Route::post('update-password', 'AdminController@updatePassword')->name('update-password');
    Route::get('clear-cache', 'AdminController@clearCache')->name('clear-cache');


    Route::resource('roles', 'RoleController')->except('show');
    Route::post('assign-role/search', 'AssignRoleController@search')->name('assign-role.search');
    Route::resource('assign-role', 'AssignRoleController')->only('index', 'store');

    Route::resource('seo', 'SeoController');
    Route::resource('env', 'EnvController');
    Route::resource('media', 'MediaController');
    Route::get('medias/list', 'MediaController@list')->name('media.list');
    Route::post('medias/delete', 'MediaController@destroy')->name('medias.delete');
    Route::get('languages/delete/{id}', 'LanguageController@destroy')->name('languages.delete');
    Route::post('languages/setActiveLanguage', 'LanguageController@setActiveLanguage')->name('languages.active');
    Route::post('languages/add_key', 'LanguageController@add_key')->name('language.add_key');
    Route::resource('language', 'LanguageController');
    Route::resource('menu', 'MenuController');
    Route::post('/menus/destroy', 'MenuController@destroy')->name('menus.destroy');
    Route::post('menues/node', 'MenuController@MenuNodeStore')->name('menus.MenuNodeStore');

    Route::resource('cron', 'CronController')->only('index');
});
