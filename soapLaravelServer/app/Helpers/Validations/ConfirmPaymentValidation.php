<?php

namespace App\Helpers\Validations;

use Illuminate\Support\Facades\Validator;
use App\Helpers\Wrappers\WrapperErrorResponse;

final class ConfirmPaymentValidation {

    public function validate($inputs)
    {
        $validator = Validator::make($inputs, [
            'id_payment' => ['required', 'integer'],
            'id_session' => ['required', 'string'],
            'token' => ['required', 'string'],
            'client_id' => ['required', 'integer']
        ], [
            'required' => 'The :attribute field is required.',
            'string' => 'The :attribute only accepts value of type string',
            'integer' => 'The :attribute only accepts value of type integer'
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