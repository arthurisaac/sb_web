<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $orders = Order::query()
            ->with("Box")
            ->with("User")
            ->whereHas("Payments", function ($query) {
                $query->where('confirmation', '0');
            })->get();

        $amountTotal = 0;
        $totalOrders = Order::query()
            //->with("Box")
            //->with("User")
            ->with("Payments")
            ->whereHas("Payments", function ($query) {
                $query->where('confirmation', '1');
            })->get();
        foreach ($totalOrders as $totalOrder)  {
            $amountTotal += $totalOrder->Payments->sum("amount");
        }

        $statsOrders = Order::query()->select(DB::raw("count(*) as total, date_format(created_at, '%m') as month"))->groupBy('month')->get();
        $users = User::query()->select(DB::raw("count(*) as total, date_format(created_at, '%m') as month"))->groupBy('month')->get();

        $month = ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"];
        $yearlyOrders = [];
        $yearlyUsers = [];

        foreach ($statsOrders as $order) {

            $yearlyOrders[] = [
                'month_name' => $month[-1 + (int)$order->month],
                'total' => $order->total
            ];
        }

        foreach ($users as $user) {
            $yearlyUsers[] = [
                'month_name' => $month[-1 + (int)$user->month],
                'total' => $user->total
            ];
        }

        $bestClients = Order::query()
            ->with("Box")
            ->with("User")
            ->with("Payments")
            ->whereHas("Payments", function ($query) {
                $query->where('confirmation', '1');
            })
            ->get();

        $coffretStats = Order::query()
            ->select(DB::raw("box, count(*) as total"))
            ->with("Box")
            //->with("User")
            ->whereHas("Payments", function ($query) {
                $query->where('confirmation', '1');
            })
            ->groupBy("box")->get();

        //dd($coffretStats);

        return view("home", compact("orders","amountTotal", "yearlyOrders", "yearlyUsers", "bestClients", "coffretStats"));
    }
}
