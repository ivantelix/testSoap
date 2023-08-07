<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ResponseResource;

class PaymentRequest {
    
    public static function validate($inputs)
    {
        $validator = Validator::make($inputs, [
            'client_id' => 'required|integer',
            'amount' => 'required|numeric'
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
            'client_id' => $inputs['client_id'],
            'amount' => $inputs['amount']
        ];
    }
}
