<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ResponseResource;
use App\Http\Requests\RechargeWalletRequest;
use App\Http\Services\SoapService;

class WalletController extends Controller
{
    public function recharge(Request $request, SoapService $soap)
    {
        $validator = RechargeWalletRequest::validate($request->all());

        if (!$validator['success']) {
            return response()->json($validator);
        }

        try {
            $payload = RechargeWalletRequest::getPayloadValue($request->all());
            $res = $soap->handler('recharge-wallet')->rechargeWallet($payload);

            return response()->json($res);
            //return response()->json(new ResponseResource($res));

        } catch (Exception $e) {

            return response()->json(new ResponseResource([
                    'success' => false,
                    'code' => 500,
                    'message_error' => 'Internal server error',
                    'data' => $e->getMessage()
                ])
            );
        }
    }    
}
