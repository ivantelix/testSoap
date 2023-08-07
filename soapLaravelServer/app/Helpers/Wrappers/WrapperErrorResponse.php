<?php

namespace App\Helpers\Wrappers;

class WrapperErrorResponse {
    
    public static function wrapper($data)
    {
        return [
            'success' => false,
            'code' => $data['code'],
            'message_error' => $data['message'],
            'data' => $data['data']
        ];
    }

}