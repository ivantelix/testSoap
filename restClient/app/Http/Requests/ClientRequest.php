<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ResponseResource;

class ClientRequest {
    
    public static function validate($inputs)
    {
        $validator = Validator::make($inputs, [
            'names' => 'required|string',
            'document' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
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
            'names' => $inputs['names'],
            'document' => $inputs['document'],
            'phone' => $inputs['phone'],
            'email' => $inputs['email']
        ];
    }
}
