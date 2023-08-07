<?php

declare(strict_types=1);

namespace App\Actions;

use App\Helpers\Wrappers\WalletWrapper;
use App\Helpers\Wrappers\WrapperSuccessResponse;
use App\Models\Client;
use App\Helpers\Validations\CheckBalanceValidation;
use App\Helpers\Wrappers\WrapperErrorResponse;

final class CheckBalance {

    public function checkBalance($data)
    {
        $validator =  new CheckBalanceValidation();
        $resValidate = $validator->validate($data);

        if (!$resValidate['success']) {
            return $resValidate;
        }

        $client = Client::with('wallet')->where([
            'phone' => $data['phone'],
            'document' => $data['document']
        ])->first();

        if ($client) {
            return !empty($client->wallet) ? WrapperSuccessResponse::wrapper([
                'message' => 'This is the balance of your wallet ',
                'data' => WalletWrapper::wrapper($client)
            ]) : null;
           
        }

        return WrapperErrorResponse::wrapper([
            'code' => 400,
            'message' => 'The client does not exist to be able to obtain the balance of the wallet',
            'data' => null
        ]);

    }
}