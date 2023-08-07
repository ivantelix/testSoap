<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ResponseResource;

class VirtualWalletController extends Controller
{
    public function registerClient(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'names' => 'required|string',
            'document' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
        ]);
 
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ]);
        }

        try {

            $payload = [
                'names' => $request->names,
                'document' => $request->document,
                'phone' => $request->phone
            ];

            $client = new \SoapClient(null, array('uri' => 'http://localhost/',
           'location' => 'http://localhost/api/register-client'));

            $res = $client->registerClient($payload);

            return response()->json($res);
        } catch (SoapFault $e) {
            return response()->json($e);
        }
    }

    /*public function RechargeMoney(Request $request)
    {
        $client = new \SoapClient(null, array('uri' => 'http://localhost/',
       'location' => 'http://localhost/api/recharge-money'));

        $res = $client->rechargeMoney();
        echo($res);
    }*/
    
}
