<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\PressController;

Route::redirect('/','/ru');

Route::get('sendbasicemail',[\App\Http\Controllers\MailController::class, 'basic_email']);
Route::get('sendhtmlemail',[\App\Http\Controllers\MailController::class, 'html_email']);
Route::get('sendattachmentemail',[\App\Http\Controllers\MailController::class, 'attachment_email']);

Route::get('sendbasicmail',[\App\Http\Controllers\MailController::class, 'basic_mail']);
Route::get('sendhtmlmail',[\App\Http\Controllers\MailController::class, 'html_mail'])->name('lol');
Route::get('sendattachmentmail',[\App\Http\Controllers\MailController::class, 'attachment_mail']);
Route::get('/migrate', [\App\Http\Controllers\MigrateController::class, 'index']);



Auth::routes();

//Route::group([
//    'prefix' => '{language?}',
//    'where' => ['language' => 'ru|kz']
//
//], function (){

Route::get(
    'setlocale/{lang}',
    function ($lang){

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
    });


    Route::get('/contacts', function () {
        return view('pages.contacts');
    })->name('contacts');

    Route::get('/press/page/{page?}', [PressController::class, 'press'])->name('press');
    Route::get('/press/{year}/{id}-{alias}', [PressController::class, 'press_detail'])->name('press_detail');
    Route::get('/press/{year?}', [PressController::class, 'press_by_year'])->name('press_by_year');

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
    Route::get('/{link}/add', [App\Http\Controllers\AdminController::class, 'getAdd'])->name('one.menu.add');

    Route::get('/edit/password/', [App\Http\Controllers\ResetController::class, 'passwordEdit'])->name('password.edit');
    Route::post('/edit/password/', [App\Http\Controllers\ResetController::class, 'passwordUpdate'])->name('password.update');

    Route::post('/insert', [App\Http\Controllers\AdminController::class, 'store'])->name('itemInsert');
    Route::delete('/{link}/{id}/', [App\Http\Controllers\AdminController::class, 'destroy'])->name('Del');

    Route::put('/edd/{id}', [App\Http\Controllers\AdminController::class, 'update'])->name('itemUpdate');

});


