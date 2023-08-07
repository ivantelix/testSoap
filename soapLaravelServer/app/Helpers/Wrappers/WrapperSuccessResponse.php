<?php

namespace App\Helpers\Wrappers;

class WrapperSuccessResponse {

    public static function wrapper($data)
    {
        return [
            'success' => true,
            'code' => '00',
            'message_success' => $data['message'],
            'data' => $data['data']
        ];
    }
}