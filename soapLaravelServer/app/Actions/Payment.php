<?php

declare(strict_types=1);

namespace App\Actions;

use Illuminate\Support\Str;

use App\Helpers\Wrappers\WrapperErrorResponse;
use App\Helpers\Wrappers\WrapperSuccessResponse;
use App\Helpers\Wrappers\PaymentWrapper;
use App\Helpers\Validations\PaymentValidation;
use App\Models\Client;
use App\Models\PaymentM;
use Illuminate\Support\Facades\DB;

class Payment {

    public function payment($data)
    {
        $validator =  new PaymentValidation();
        $resValidate = $validator->validate($data);

        if (!$resValidate['success']) {
            return $resValidate;
        }

        $client = Client::find($data['client_id']);

        try {
            DB::beginTransaction();


            if ($client->wallet->balance >= $data['amount']) {
    
                $payment = PaymentM::create([
                    'client_id' => $client->id,
                    'amount' => $data['amount'],
                    'token' => Str::random(6),
                ]);
    
                $client->update([
                    'id_session' => Str::uuid()
                ]);
    
                $client->wallet()->update([
                    'balance' => $client->wallet->balance - $data['amount'],
                    'blocked_balance' => $client->wallet->blocked_balance + $data['amount']
                ]);
    
                DB::commit();
    
                return WrapperSuccessResponse::wrapper([
                    'message' => 'A token has been sent to your email to confirm the purchase',
                    'data' => PaymentWrapper::wrapper($payment)
                ]);
            }
    
            return WrapperErrorResponse::wrapper([
                'code' => 400,
                'message' => 'You dont have enough money, try to top up first.',
                'data' => null
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return WrapperErrorResponse::wrapper([
                'code' => 500,
                'message' => 'Internal server error.',
                'data' => $e->getMessage()
            ]);
        }

    }

}