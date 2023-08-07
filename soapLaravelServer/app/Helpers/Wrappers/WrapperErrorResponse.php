<?php

namespace App\Helpers\Wrappers;

class WrapperErrorResponse {
    
    public static function wrapper($data)
    {
        return [
            'success' => false,
            'code' => 400,
            'message_error' => 'Bad request',
            'data' => $data
        ];
    }

}