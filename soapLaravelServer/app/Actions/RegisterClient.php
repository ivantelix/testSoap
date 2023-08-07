<?php

declare(strict_types=1);

namespace App\Actions;

use App\Helpers\Wrappers\ClientWrapper;
use App\Helpers\Wrappers\WrapperSuccessResponse;
use App\Models\Client;
use App\Helpers\ClientValidation;


final class RegisterClient {

    public function registerClient($data)
    {
        $validator =  new ClientValidation();
        $resValidate = $validator->validate($data);

        if (!$resValidate['success']) {
            return $resValidate;
        }

        $user = Client::create([
            'names' => $data['names'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'document' => $data['document']
        ]);

        return WrapperSuccessResponse::wrapper([
            'message' => 'Client registered successfully',
            'data' => ClientWrapper::wrapper($user)
        ]);

    }
}