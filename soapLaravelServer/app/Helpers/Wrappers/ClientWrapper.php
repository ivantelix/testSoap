<?php

namespace App\Helpers\Wrappers;

class ClientWrapper {

    public static function wrapper($data)
    {
        return [
            'id' => $data->id,
            'names' => $data->names,
        ];
    }
}