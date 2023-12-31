<?php

namespace App\Http\Controllers;

use App\Http\Services\SoapService;

use App\Actions\RegisterClient;
use App\Actions\RechargeWallet;
use App\Actions\CheckBalance;
use App\Actions\Payment;
use App\Actions\ConfirmPayment;

class SoapController extends Controller
{
    public function registerClient(SoapService $soap, RegisterClient $action_class) {
        $soap->handler($action_class);
    }

    public function rechargeWallet(SoapService $soap, RechargeWallet $action_class) {
        $soap->handler($action_class);
    }

    public function checkBalance(SoapService $soap, CheckBalance $action_class) {
        $soap->handler($action_class);
    }

    public function payment(SoapService $soap, Payment $action_class) {
        $soap->handler($action_class);
    }

    public function confirmPayment(SoapService $soap, ConfirmPayment $action_class) {
        $soap->handler($action_class);
    }
}