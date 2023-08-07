<?php

namespace App\Helpers\Wrappers;

class SuccessWrapperResponse {

    public static function wrapper($data)
    {
        return [
            'success' => true,
            'code' => 00,
            'data' => $data
        ];
    }
}