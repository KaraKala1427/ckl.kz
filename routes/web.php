<?php

use App\Http\Controllers\ApiConnectController;
use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\CovidController;
use App\Http\Controllers\DevController;
use App\Http\Controllers\EpayController;
use App\Http\Controllers\ForteController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\MigrateController;
use App\Http\Controllers\SandBoxController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\PressController;

Route::redirect('/','/ru');

Route::get('sendbasicemail',[MailController::class, 'basic_email']);
Route::get('sendhtmlemail',[MailController::class, 'html_email']);
Route::get('/send-order-email',[MailController::class, 'sendOrderToEmail'])->name('covid.send-email');
Route::get('sendattachmentemail',[MailController::class, 'attachment_email']);

Route::get('sendbasicmail',[MailController::class, 'basic_mail']);
Route::get('sendhtmlmail',[MailController::class, 'html_mail'])->name('lol');
Route::get('sendattachmentmail',[MailController::class, 'attachment_mail']);
Route::get('/migrate', [MigrateController::class, 'index']);
Route::get('/runseeder', [MigrateController::class, 'run_seeder']);
Route::get('/link', [DevController::class, 'link']);
Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});
Route::get('/curltest', [MailController::class, 'test']);


Route::view('/program-covid','pages.program_covid')->name('program-covid');

Route::post('/agent-login', [ForteController::class, 'forteLogin'])->name('forteLogin');


Route::group(['middleware' => ['web', 'custom_auth']], function () {
    Route::get('/covid/logout',[ForteController::class, 'forteLogout'])->name('forte-logout');
});


Auth::routes();

Route::group([
    'namespace'  => 'App\\Http\\Controllers\\Files',
    'middleware' => config('filemanager.middleware')
], function () {
    Route::get(config('filemanager.base_route'), 'FilemanagerController@getIndex')
        ->name('filemanager.base_route');
});

Route::get('setlocale/{lang}', function ($lang){

        $referer = Redirect::back()->getTargetUrl();
        $parse_url = parse_url($referer, PHP_URL_PATH);
        $segments = explode('/',  $parse_url);

        if (in_array($segments[1], App\Http\Middleware\Locale::$languages)){
            unset($segments[1]);
        }
        if ($lang != App\Http\Middleware\Locale::$mainLanguage){
            array_splice($segments, 1, 0, $lang);
        }
        $url = Request::root() .implode("/", $segments);
        if(parse_url($referer, PHP_URL_QUERY)){
                $url = $url . '?' . parse_url($referer, PHP_URL_QUERY);
        }
        $url =  str_replace(env('APP_URL'), "", $url);
        return  redirect($url);

    }
)->name('setlocale');

Route::group([
    'prefix' => App\Http\Middleware\Locale::getLocale(),

], function (){

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/product', [ProductController::class, 'index'])->name('product');
    Route::get('/annuitet', [ProductController::class, 'annuitet'])->name('annuitet');
    Route::get('/live', [ProductController::class, 'live'])->name('live');
    Route::get('/live/gccj', [ProductController::class, 'live_gccj'])->name('live_gccj');
    Route::get('/live/zaemwik', [ProductController::class, 'live_zaemwik'])->name('live_zaemwik');
    Route::get('/live/nsj', [ProductController::class, 'live_nsj'])->name('live_nsj');
    Route::get('/live/nsj-rebenka', [ProductController::class, 'live_ncj_rebenka'])->name('live_nsj_rebenka');
    Route::get('/live/nsj-valutnyi', [ProductController::class, 'live_nsj_valutnyi'])->name('live_nsj_valutnyi');
    Route::get('/retirementinsurance', [ProductController::class, 'retirementinsurance'])->name('retirementinsurance');
    Route::group(['prefix' => '/about', 'as' => 'about'], function () {
        Route::get('/history',[AboutController::class, 'get_history'])->name('.history');

        Route::get('/team', [AboutController::class, 'get_team'])->name('.team');

        Route::get('/license', [AboutController::class, 'get_license'])->name('.license');

        Route::get('/financial_statements', [AboutController::class, 'get_financial_statements'])->name('.financial_statements');

        Route::get('/corporate_events', [AboutController::class, 'get_corporate_events'])->name('.corporate_events');

        Route::get('/akcioneram', [AboutController::class, 'get_akcioneram'])->name('.akcioneram');

        Route::get('/compliance_controller', [AboutController::class, 'get_compliance_controller'])->name('.compliance_controller');

        Route::get('/informaciya_dlya_insayderov',  [AboutController::class, 'get_informaciya_dlya_insayderov'])->name('.informaciya_dlya_insayderov');

        Route::get('/tarify', [AboutController::class, 'get_tarify'])->name('.tarify');

        Route::get('/agents', [AboutController::class, 'get_agents'])->name('.agents');

        Route::get('/requisites', [AboutController::class, 'get_requisites'])->name('.requisites');

        Route::get('/security', [AboutController::class, 'get_security'])->name('.security');

        Route::get('/clients-and-recommendations', [AboutController::class, 'get_clients_recommendations'])->name('.clients-and-rec');
    });

    Route::get('/contacts',[HomeController::class,'getContacts'])->name('contacts');
    Route::get('/sandbox',[SandBoxController::class,'sandbox'])->name('sandbox');
    Route::get('/press/page/{page?}', [PressController::class, 'press'])->name('press');
    Route::get('/press/{year}/{id}-{alias}', [PressController::class, 'press_detail'])->name('press_detail');
    Route::get('/press/{year?}', [PressController::class, 'press_by_year'])->name('press_by_year');

    Route::get('/covid', [CovidController::class, 'index'])->name('covid');
    Route::post('/covid/getSubject', [CovidController::class, 'getClient'])->name('covid.getClient');
    Route::post('/covid/getProgram', [CovidController::class, 'getProgramIsn'])->name('covid.getProgramIsn');
    Route::post('/covid/setOrder', [CovidController::class, 'setOrder'])->name('covid.setOrder');
    Route::post('/covid/next-step', [CovidController::class, 'nextStep'])->name('covid.nextStep');
    Route::post('/covid/prev-step', [CovidController::class, 'prevStep'])->name('covid.prevStep');
    Route::post('/covid/send-sms', [CovidController::class, 'sendSms'])->name('covid.sendSms');
    Route::post('/covid/confirm-sms', [CovidController::class, 'confirmCode'])->name('covid.confirmCode');

    Route::post('/covid/sendSmsLinkToPhone', [CovidController::class, 'sendSmsLinkToPhone'])->name('covid.sendSmsLinkToPhone');
    Route::post('/covid/sendSmsToPhone', [CovidController::class, 'sendSmsToPhone']);
    Route::post('/covid/setAgrStatus', [CovidController::class, 'setAgrStatus']);

    Route::get('/covid/epay-redirect', [EpayController::class, 'epayRedirect'])->name('covid.epay-redirect');
//    Route::get('/covid/success-payment', [EpayController::class, 'successPayment'])->name('covid.success-payment');
    Route::get('/covid/success-payment', [CovidController::class, 'successPaymentPage'])->name('covid.getResult');
    Route::get('/covid/failure-payment', [EpayController::class, 'failurePayment'])->name('covid.failure-payment');


    Route::get('/checkpolicy', [CaptchaController::class, 'index'])->name('checkpolicy');
    Route::get('/captcha-validation', [CaptchaController::class, 'capthcaFormValidate']);
    Route::get('/reload-captcha', [CaptchaController::class, 'reloadCaptcha']);
    Route::view('/covid/agent-login','pages.agent_login')->name('agent.login');
});

Route::group([
    "as"=>"admin.",
    "middleware"=>"admin",
    "prefix"=>"/admin"
],function (){
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('index');
    Route::get('/menu/{link}', [App\Http\Controllers\AdminController::class, 'getParentMenu'])->name('menus');
    Route::get('/menu/{link}/add', [App\Http\Controllers\AdminController::class, 'getMenuAdd'])->name('menu.add');
    Route::post('/menu/create/', [App\Http\Controllers\AdminController::class, 'postMenu'])->name('menuCreate');
    Route::get('/menu/{link}/delete/{id}', [App\Http\Controllers\AdminController::class, 'deleteMenu'])->name('menu.delete');

    Route::get('/{link}/list', [App\Http\Controllers\AdminController::class, 'getLink'])->name('one.menu');
    Route::get('/{link}/edd/{id}', [App\Http\Controllers\AdminController::class, 'getArticle'])->name('one.menu.edit');
    Route::get('/{link}/edd/{id}/thumb', [App\Http\Controllers\AdminController::class, 'getThumbEdit'])->name('thumb.edit');
    Route::get('/{link}/add', [App\Http\Controllers\AdminController::class, 'getAdd'])->name('one.menu.add');
    Route::get('/{link}/addThumb', [App\Http\Controllers\AdminController::class, 'getThumbAdd'])->name('thumbAdd');
    Route::get('/{link}/edit/{id}/plug-covid', [App\Http\Controllers\AdminController::class, 'getPlugCovid'])->name('plug-covid');

    Route::get('/edit/password/', [App\Http\Controllers\ResetController::class, 'passwordEdit'])->name('password.edit');
    Route::post('/edit/password/', [App\Http\Controllers\ResetController::class, 'passwordUpdate'])->name('password.update');

    Route::post('/insert', [App\Http\Controllers\AdminController::class, 'store'])->name('itemInsert');
    Route::delete('/{link}/{id}/', [App\Http\Controllers\AdminController::class, 'destroy'])->name('Del');

    Route::put('/edd/{id}', [App\Http\Controllers\AdminController::class, 'update'])->name('itemUpdate');
    Route::put('/edd/{id}/thumb', [App\Http\Controllers\AdminController::class, 'thumbUpdate'])->name('thumbUpdate');
    Route::post('/insertThumb', [App\Http\Controllers\AdminController::class, 'postThumb'])->name('insertThumb');
    Route::post('/edd/{id}/update-plug', [App\Http\Controllers\AdminController::class, 'postPlug'])->name('plug-covid-post');
});
