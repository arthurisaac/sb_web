<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiResource;
use App\Mail\SendReservationEdited;
use App\Mail\SendReservationRequestAdmin;
use App\Mail\SendSuccessReserved;
use App\Models\Order;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
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
            'box' => 'required',
            'delivery' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $order = new Order([
            'user' => $request->get('user'),
            'box' => $request->get('box'),
            'delivery_place' => $request->get('delivery_place'),
            'nom_client' => $request->get('nom_client'),
            'prenom_client' => $request->get('prenom_client'),
            'ville_client' => $request->get('ville_client'),
            'pays_client' => $request->get('pays_client'),
            'telephone_client' => $request->get('telephone_client'),
            'mail_client' => $request->get('mail_client'),
            'promo_code' => $request->get('promo_code'),
            'total' => $request->get('total'),
            'payment_method' => $request->get('payment_method'),
            'order_confirmation' => $request->get('order_confirmation'),
            'delivrey_confirmation' => $request->get('delivrey_confirmation'),
            'trique' => $this->random_strings(14),
            'delivery' => $request->get("delivery")
        ]);
        $order->save();

        return response()->json([
            'message' => 'Order saved successfully.',
            'order' => $order,
        ], 201);
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

    function random_strings($length_of_string)
    {

        // String of all alphanumeric character
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

        // Shuffle the $str_result and returns substring
        // of specified length
        return substr(str_shuffle($str_result),
            0, $length_of_string);
    }

    public function checkNumber(Request $request)
    {
        $request->validate([
            "number" => "required"
        ]);
        $number = $request->get("number");
        $order = Order::with("Box")->where("trique", $number)->first();

        return response()->json([
            'order' => $order,
        ]);
    }

    public function madeConfirmation(Request $request)
    {
        $request->validate([
            "order_id" => "required",
            "user" => "required"
        ]);

        $order = Order::query()->find($request->get("order_id"));
        if ($order) {
            $order->order_confirmation = $request->get("user");
        }
        $order->save();

        return response()->json([
            'message' => 'Order confirmed successfully.',
        ]);
    }

    public function reserveOrder(Request $request)
    {
        $request->validate([
            "order_id" => "required",
            "reservation_date" => "required",
            "is_edit" => "required",
        ]);

        $order = Order::query()->find($request->get("order_id"));
        if ($order) {
            $order->reservation = $request->get("reservation_date");
            $order->status = 0;
        }
        $order->save();

        $box = $order->Box;
        $user = $order->User;

        $reservation =  date("d-m-Y", strtotime($request->get("reservation_date")));
        if ($user && $box) {
            if ($request->get("is_edit") == "false") {
                Mail::to($user->email)->send(new SendSuccessReserved($box, $reservation));
            } else {
                Mail::to($user->email)->send(new SendReservationEdited($box, $reservation));
            }
        }
        $users = User::query()
            ->whereHas("roles", function ($query) {
                $query->where("name", "admin");
            })
            ->get();

        foreach ($users as $u) {
            Mail::to($u->email)->send(new SendReservationRequestAdmin($box, $user, $reservation));
        }

        /*$reservation = new Reservation([
            'box' => $box->id,
            'user' => $user->id,
            'order' => $order->id,
            'status' => 0,
            'reservation' => $request->get("reservation_date"),
        ]);
        $reservation->save();*/

        return response()->json([
            'message' => 'Order reservation successfully.',
        ]);
    }

    public function getSavedOrders(Request $request)
    {
        $request->validate([
            "order_confirmation" => "required",
        ]);

        $orders = Order::with("Box")->where("order_confirmation", $request->get("order_confirmation"))->get();

        return new ApiResource($orders);
    }
}
