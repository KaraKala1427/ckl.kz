<?php

use App\Http\Controllers\CovidController;
use App\Http\Controllers\EpayController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/epay/auth', [EpayController::class, 'paymentAuth'])->name('epay.payment-auth');
Route::post('/epay/response', [EpayController::class, 'paymentResponse'])->name('covid.payment-response');
Route::get('/epay/status', [EpayController::class, 'getStatus']);


