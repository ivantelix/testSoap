<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ResponseResource;
use App\Http\Requests\ClientRequest;
use App\Http\Services\SoapService;

class ClientController extends Controller
{
    public function registerClient(Request $request, SoapService $soap)
    {
        $validator = ClientRequest::validate($request->all());

        if (!$validator['success']) {
            return response()->json($validator);
        }

        try {
            $payload = ClientRequest::getPayloadValue($request->all());
            $res = $soap->handler()->registerClient($payload);

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
}
