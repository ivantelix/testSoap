<?php

namespace App\Helpers\Wrappers;

class PaymentWrapper {

    public static function wrapper($data)
    {
        return [
            'id' => $data->id,
            'id_session' => $data->client->id_session,
            'amount' => $data->amount,
            'status' => $data->status
        ];
    }
}