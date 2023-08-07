<?php

namespace App\Validation;

use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ResponseResource;

class ClientValidation {

    public function validate($inputs)
    {
        $validator = Validator::make($inputs, [
            'email' => ['required', 'string', 'email'],
            'phone' => ['required', 'string'],
            'names' => ['required', 'string'],
            'document' => ['required', 'string']
        ], [
            'required' => 'The :attribute field is required.',
        ]);

        if ($validator->fails()) {
            $res = [
                'success' => false,
                'code' => 400,
                'message_error' => 'Bad request',
                'data' => json_encode($validator->errors())
            ];
        }
        else {
            $res = [
                'success' => true
            ];
        }

        return ResponseResource::collection($res);
    }

}