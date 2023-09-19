<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Mail\SendBoxCode;
use App\Mail\SendSuccessBuy;
use App\Models\Box;
use App\Models\Order;
use App\Models\OrderPayment;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class OrderPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user' => 'required',
            'order' => 'required',
            'amount' => 'required',
            'phone_number' => 'required',
            'otp_code' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $amount = (int)$request->get("amount");
        $ext_txn_id = time();
        $otp = $request->get("otp_code");
        $phone_number = $request->get("phone_number");
        $user = $request->get("user");

        /*$xml = "<?xml version='1.0' encoding='UTF-8'?>
                <COMMAND>
                <TYPE>OMPREQ</TYPE>
                <customer_msisdn>$phone_number</customer_msisdn>
                <merchant_msisdn>76688276</merchant_msisdn>
                <api_username>YGGTEST</api_username>
                <api_password>Orange@123</api_password>
                <amount>$amount</amount>
                <PROVIDER>101</PROVIDER>
                <PROVIDER2>101</PROVIDER2>
                <PAYID>12</PAYID>
                <PAYID2>12</PAYID2>
                <otp>$otp</otp>
                <reference_number>789233</reference_number>
                <ext_txn_id>201500068544</ext_txn_id>
                </COMMAND>";

        $url = "https://testom.orange.bf:9008/payment";
        $send_context = stream_context_create(array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-Type: application/xml',
                'content' => $xml
            )
        ));
        $response =  file_get_contents($url, false, $send_context);

        $xml=simplexml_load_string("<response>" . $response . "</response>") or die("Error: Cannot create object");*/

       // if ($xml->status == 200) {
            $payment = new OrderPayment([
                'order' => $request->get('order'),
                'user' => $request->get('user'),
                'amount' => $request->get('amount'),
                'payment_method' => $request->get('payment_method'),
                'phone_number' => $request->get('phone_number'),
                'opt_code' => $request->get('opt_code'),
            ]);
            $payment->save();

            $order = Order::query()->find($payment->order);
            $boxID = $order->box;
            $box = Box::query()->find($boxID);

            $user = User::query()->find($request->get("user"));
            if ($user) {
                Mail::to($user->email)->send(new SendSuccessBuy($box, $payment));
            }


            return response()->json([
                'message' => 'Payment saved successfully.',
            ], 201);
       /* } else {
            return response()->json([
                'message' => 'Une erreur dans le paiement.',
                'data' => $xml
            ]);
        }*/

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
