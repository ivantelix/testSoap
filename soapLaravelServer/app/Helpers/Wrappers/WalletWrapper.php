<?php

namespace App\Helpers\Wrappers;

class WalletWrapper {

    public static function wrapper($data)
    {
        return [
            'id' => $data->id,
            'balance' => $data->wallet->balance
        ];
    }
}