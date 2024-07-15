<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Costumer;
use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use App\Models\Order; // Assuming you have an Order model

class HomeController extends Controller
{
    public function home()
    {   
        $usersCount = User::count();
        $clientsCount = Costumer::count();
        $ordersCount = Order::count();
        $totalOrders = Order::sum('total');

        $confirmedCount = Order::where('confirmed', true)->count();
        $processingCount = Order::where('status', 'processing')->count();
        $canceledCount = Order::where('status', 'canceled')->count();

        return view('dashboard', compact('confirmedCount','processingCount','canceledCount','usersCount','totalOrders','clientsCount','ordersCount'));
    }
}
