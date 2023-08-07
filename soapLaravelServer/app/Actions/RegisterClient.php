<?php

declare(strict_types=1);

namespace App\Actions;

use App\Helpers\Wrappers\ClientWrapper;
use App\Helpers\Wrappers\SuccessWrapperResponse;
use App\Http\Resources\ClientResource;
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

        SuccessWrapperResponse::wrapper(ClientWrapper::wrapper($user));

    }
}