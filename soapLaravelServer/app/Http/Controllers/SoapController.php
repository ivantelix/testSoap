<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Services\SoapService;
use App\Actions\RegisterClient;
use App\Actions\RechargeWallet;

class SoapController extends Controller
{
    public function registerClient(SoapService $soap, RegisterClient $action_class) {
        $soap->handler($action_class);
    }

    public function rechargeWallet(SoapService $soap, RechargeWallet $action_class) {
        $soap->handler($action_class);
    }
}