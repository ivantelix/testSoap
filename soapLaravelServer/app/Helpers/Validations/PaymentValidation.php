<?php

namespace App\Helpers\Validations;

use Illuminate\Support\Facades\Validator;
use App\Helpers\Wrappers\WrapperErrorResponse;

final class PaymentValidation {

    public function validate($inputs)
    {
        $validator = Validator::make($inputs, [
            'client_id' => ['required', 'integer'],
            'amount' => ['required', 'numeric']
        ], [
            'required' => 'The :attribute field is required.',
            'integer' => 'The :attribute only accepts value of type integer',
            'numeric' => 'The :attribute only accepts value of type numeric'
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