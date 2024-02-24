<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiResource;
use App\Mail\SendSuccessBoxChange;
use App\Mail\SendSuccessBuy;
use App\Models\Box;
use App\Models\Order;
use App\Models\OrderPayment;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class BoxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $boxes = Box::query()->get();
        return new ApiResource($boxes);
    }

    public function boxesWithSamePrice(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "price" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = $request->get("user");

        $boxes = Box::query()
            ->with('images')
            ->with('favorites', function($q) use ($user) {
                $q->where('user', $user);
            })
            ->where("price", '>=', $request->get("price"))
            ->orWhere("discount",'>=', $request->get("price"))
            ->get();

        return new ApiResource($boxes);
    }

    public function showBoxOfACategory(Request $request)
    {
        $request->validate([
            "category" => "required",
        ]);
        $user = $request->get("user");

        $boxes = Box::with('images')
            ->with('favorites', function($q) use ($user) {
                $q->where('user', $user);
            })
            //->whereRelation("favorites", "user", $user)
            ->where("category", $request->get("category"))
            ->get();

        $subcategories = SubCategory::with('Items')->where("category", $request->get("category"))->get();
        return response()->json([
            'boxes' => $boxes,
            'sub_categories' => $subcategories,
        ]);
    }

    public function search(Request $request) {
        $validator = Validator::make($request->all(), [
            "q" => "required",
        ]);
        $user = $request->get("user");

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $boxes = Box::with('images')
            ->with('favorites', function($q) use ($user) {
                $q->where('user', $user);
            })
            //->whereRelation("favorites", "user", $user)
            ->when($request->q,
                function (Builder $builder) use ($request) {
                    $builder->where('name', 'like', "%{$request->q}%")
                        ->orWhere('description', 'like', "%{$request->q}%");
                })
            ->get();
        return new ApiResource($boxes);
    }

    public function exchangeBox(Request $request) {
        $validator = Validator::make($request->all(), [
            "order" => "required",
            "user" => "required",
            "box" => "required",
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

        $order = Order::with("Box")
            ->with("User")
            ->find($request->get("order"));

        // Check if box price is greater than order amount
        $boxToExchange = Box::query()->find($request->get('box'));
        if ($boxToExchange) {
            $boxToExchangePrice = $boxToExchange->price;
            if ($boxToExchange->discount > 0) {
                $boxToExchangePrice = $boxToExchange->discount;
            }
            // Compare new box to order price. If price est greater then we make payment
            if ($boxToExchangePrice > $order->total) {
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
        $response = file_get_contents($url, false, $send_context);

        $xml = simplexml_load_string("<response>" . $response . "</response>") or die("Error: Cannot create object");*/

                //if ($xml->status == 200) {
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

                if ($order) {
                    $order->box = $request->get("box");
                    $order->save();
                }

                $order = Order::with("Box")
                    ->with("User")
                    ->find($request->get("order"));

                $user = $order->User;
                $box = $order->Box;

                if ($user && $box) {
                    Mail::to($user->email)->send(new SendSuccessBoxChange($box));
                }

                return response()->json([
                    'message' => 'Payment saved successfully.',
                ], 201);
                /*} else {
                    return response()->json([
                        'message' => 'Une erreur dans le paiement.',
                        'data' => $xml
                    ]);
                }*/
            } else {

                // New exchange
                if ($order) {
                    $order->box = $request->get("box");
                    $order->save();
                }

                return response()->json([
                    'message' => 'Cadeau échangé avec succès',
                ]);

            }
        }

        return response()->json([
            'message' => 'Cadeau non échangé',
        ], 404);
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
        //
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
