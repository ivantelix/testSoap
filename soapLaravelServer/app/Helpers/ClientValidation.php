<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Validator;
use App\Helpers\Wrappers\WrapperErrorResponse;

final class ClientValidation {

    public function validate($inputs)
    {
        $validator = Validator::make($inputs, [
            'email' => ['required', 'string', 'email', 'unique:clients'],
            'phone' => ['required', 'string', 'unique:clients'],
            'names' => ['required', 'string'],
            'document' => ['required', 'string', 'unique:clients']
        ], [
            'required' => 'The :attribute field is required.',
            'email' => 'The :attribute invalid email format',
            'unique' => 'The :attribute already exist'
        ]);

        if ($validator->fails()) {
            $errors = json_decode($validator->errors());
            return WrapperErrorResponse::wrapper([
                'code' => 400,
                'message' => 'Bad request',
                'data' => $errors
            ]);
        }
        else {
            $res = [
                'success' => true
            ];
        }

        return $res;

    }

}