<?php

namespace App\Helpers\Validations;

use Illuminate\Support\Facades\Validator;
use App\Helpers\Wrappers\WrapperErrorResponse;

final class CheckBalanceValidation {

    public function validate($inputs)
    {
        $validator = Validator::make($inputs, [
            'document' => ['required', 'string'],
            'phone' => ['required', 'string']
        ], [
            'required' => 'The :attribute field is required.',
            'string' => 'The :attribute only accepts value of type string'
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