<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('register-client', 'ClientController@registerClient');
$router->post('recharge-wallet', 'WalletController@recharge');
$router->post('check-balance', 'WalletController@checkBalance');
$router->post('payment', 'PaymentController@payment');
$router->post('confirm-payment', 'PaymentController@confirmPayment');