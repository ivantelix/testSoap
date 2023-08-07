<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ResponseResource;

class ConfirmPaymentRequest {
    
    public static function validate($inputs)
    {
        $validator = Validator::make($inputs, [
            'id_payment' => 'required|integer',
            'id_session' => 'required|string',
            'token' => 'required|string',
            'client_id' => 'required|numeric'
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
            'id_payment' => $inputs['id_payment'],
            'id_session' => $inputs['id_session'],
            'token' => $inputs['token'],
            'client_id' => $inputs['client_id']
        ];
    }
}
