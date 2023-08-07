<?php

declare(strict_types=1);

namespace App\Actions;

use App\Helpers\Wrappers\WalletWrapper;
use App\Helpers\Wrappers\WrapperSuccessResponse;
use App\Models\Client;
use App\Helpers\Validations\RechargeWalletValidation;
use App\Helpers\Wrappers\WrapperErrorResponse;

final class RechargeWallet {

    public function rechargeWallet($data)
    {
        $validator =  new RechargeWalletValidation();
        $resValidate = $validator->validate($data);

        if (!$resValidate['success']) {
            return $resValidate;
        }

        $client = Client::with('wallet')->where([
            'phone' => $data['phone'],
            'document' => $data['document']
        ])->first();

        if ($client) {

            empty($client->wallet)
                ? $client->wallet()->create([
                    'balance' => $data['amount']
                ])
                : $client->wallet()->update([
                    'balance' => $client->wallet->balance + $data['amount']
                ]);

            $client = Client::find($client->id);

            return WrapperSuccessResponse::wrapper([
                'message' => 'Wallet was recharged successfully',
                'data' => WalletWrapper::wrapper($client)
            ]);
        }


        return WrapperErrorResponse::wrapper([
            'code' => 400,
            'message' => 'Client dont exist for can recharge the wallet',
            'data' => null
        ]);

    }
}