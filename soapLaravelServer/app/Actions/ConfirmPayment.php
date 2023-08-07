<?php

declare(strict_types=1);

namespace App\Actions;

use Illuminate\Support\Str;

use App\Helpers\Wrappers\WrapperErrorResponse;
use App\Helpers\Wrappers\WrapperSuccessResponse;
use App\Helpers\Wrappers\PaymentWrapper;
use App\Helpers\Validations\ConfirmPaymentValidation;
use App\Models\Client;
use App\Models\PaymentM;
use Illuminate\Support\Facades\DB;

class ConfirmPayment {

    public function confirmPayment($data)
    {
        $validator =  new ConfirmPaymentValidation();
        $resValidate = $validator->validate($data);

        if (!$resValidate['success']) {
            return $resValidate;
        }

        try {
            DB::beginTransaction();

            $client = Client::find($data['client_id']);
            $payment = PaymentM::find($data['id_payment']);

            if ($client->id_session == $data['id_session'] && $payment->token == $data['token']) {
    
                $payment->update(['status' => 'paid', 'token' => null]);
    
                $client->update(['id_session' => null]);
    
                $client->wallet()->update([
                    'blocked_balance' => $client->wallet->blocked_balance - $payment->amount
                ]);
    
                DB::commit();
    
                return WrapperSuccessResponse::wrapper([
                    'message' => 'Your payment was confirm successfully',
                    'data' => PaymentWrapper::wrapper($payment)
                ]);
            }
    
            return WrapperErrorResponse::wrapper([
                'code' => 400,
                'message' => 'The token or id_session does not match the saved values. Try again.',
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