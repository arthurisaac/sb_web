<?php

namespace App\Http\Controllers;

use App\Mail\SendBoxCode;
use App\Models\Order;
use App\Models\OrderPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pendingOrders = Order::query()
            ->with("Box")
            ->with("User")
            ->whereHas("Payments", function ($query) {
                $query->where('confirmation', '0');
            })
            ->get();

        $allOrders = Order::query()
            ->with("Box")
            ->with("User")
            ->get();


        return view("orders.index", compact("pendingOrders", "allOrders"));
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
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $order = Order::query()->find($id);
        $payment = OrderPayment::query()->where("order", $id)->first();
        return view("orders.edit", compact("order", "payment"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $order = Order::query()->find($id);
        $order?->delete();

        return redirect()->route("orders.index")->with("success", "Enregistré avec succès");
    }

    public function confirm(Request $request)
    {
        $request->validate([
            "order" => "required",
            "confirmation" => "required",
            "payment" => "required",
        ]);
        $order = Order::with("Box")
            ->with("User")
            ->find($request->get("order"));
        $payment = OrderPayment::query()->find($request->get("payment"));

        if ($payment) {
            $payment->confirmation = $request->get("confirmation");
            $payment->save();
            if ($request->confirmation == -1) {
                return redirect()->back()->with("success", "Paiement refusé avec succès");
            }
        }

        if ($order) {
            $box = $order->Box;
            $user = $order->User;

            Mail::to($order->mail_client)->send(new SendBoxCode($box, $order, $user));

            if ($order->delivery == "mail") {
                Mail::to($order->delivery_place)->send(new SendBoxCode($box, $order, $user));
            }
        }

        return redirect()->back()->with("success", "Paiement confirmé avec succès");
    }
}
