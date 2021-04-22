<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\PressController;

Route::redirect('/','/ru');

Route::group([
    'prefix' => '{language}'

], function (){
    Route::get('/', [HomeController::class, 'index'])->name('index_page');

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
    });


    Route::get('/contacts/contacts', function () {
        return view('pages.contacts');
    })->name('contacts');

    Route::get('/press', [PressController::class, 'press'])->name('press');
    Route::get('/press/{year}/{id}-{alias}', [PressController::class, 'press_detail'])->name('press_detail');
    Route::get('/press/{year}', [PressController::class, 'press_by_year'])->name('press_by_year');

});


