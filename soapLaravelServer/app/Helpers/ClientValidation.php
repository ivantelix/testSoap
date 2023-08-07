<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Validator;
use App\Helpers\Wrappers\WrapperErrorResponse;

final class ClientValidation {

    public function validate($inputs)
    {
        $validator = Validator::make($inputs, [
            'email' => ['required', 'string', 'email'],
            'phone' => ['required', 'string'],
            'names' => ['required', 'string'],
            'document' => ['required', 'string']
        ], [
            'required' => 'The :attribute field is required.',
            'email' => 'The :attribute invalid email format'
        ]);

        if ($validator->fails()) {
            $errors = json_decode($validator->errors());
            return WrapperErrorResponse::wrapper($errors);
        }
        else {
            $res = [
                'success' => true
            ];
        }

        return $res;

    }

}