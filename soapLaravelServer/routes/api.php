<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SoapController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register-client', [SoapController::class, 'registerClient']);
Route::post('recharge-wallet', [SoapController::class, 'rechargeWallet']);
Route::post('check-balance', [SoapController::class, 'checkBalance']);
Route::post('payment', [SoapController::class, 'payment']);
Route::post('confirm-payment', [SoapController::class, 'confirmPayment']);
