<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ResponseResource;
use App\Http\Requests\PaymentRequest;
use App\Http\Requests\ConfirmPaymentRequest;
use App\Http\Services\SoapService;

class PaymentController extends Controller
{
    public function payment(Request $request, SoapService $soap)
    {
        $validator = PaymentRequest::validate($request->all());

        if (!$validator['success']) {
            return response()->json($validator);
        }

        try {
            $payload = PaymentRequest::getPayloadValue($request->all());
            $res = $soap->handler('payment')->payment($payload);
            
            return response()->json(new ResponseResource($res));

        } catch (Exception $e) {

            return response()->json(new ResponseResource([
                    'success' => false,
                    'code' => 500,
                    'message_error' => 'Internal server error',
                    'data' => $e->getMessage()
                ])
            );
        }
    }  

    public function confirmPayment(Request $request, SoapService $soap)  
    {

        $validator = ConfirmPaymentRequest::validate($request->all());

        if (!$validator['success']) {
            return response()->json($validator);
        }

        try {
            $payload = ConfirmPaymentRequest::getPayloadValue($request->all());
            $res = $soap->handler('confirm-payment')->confirmPayment($payload);

            return response()->json(new ResponseResource($res));

        } catch (Exception $e) {

            return response()->json(new ResponseResource([
                    'success' => false,
                    'code' => 500,
                    'message_error' => 'Inqweqweternal server error',
                    'data' => $e->getMessage()
                ])
            );
        }
    }
}
