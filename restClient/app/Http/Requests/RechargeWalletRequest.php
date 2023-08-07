<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ResponseResource;

class RechargeWalletRequest {
    
    public static function validate($inputs)
    {
        $validator = Validator::make($inputs, [
            'document' => 'required|string',
            'phone' => 'required|string',
            'amount' => 'required|numeric',
        ]);
 
        if ($validator->fails()) {
            $res = [
                'success' => false,
                'code' => 400,
                'message_error' => 'Bad request',
                'data' => $validator->errors()
            ];
        }
        else {
            $res = [
                'success' => true
            ];
        }

        return new ResponseResource($res);

    }

    public static function getPayloadValue($inputs)
    {
        return [
            'document' => $inputs['document'],
            'phone' => $inputs['phone'],
            'amount' => $inputs['amount']
        ];
    }
}
