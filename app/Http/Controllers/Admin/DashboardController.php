<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\TravelPackage;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $orders = Order::count();
        $orderscount = Order::count();
        $acppetOrder = Order::where('status', 2)->count();
        $waitingOrders = Order::where('status', '!=', 2)->count();
        $Travel = TravelPackage::count();
        return view('admin.dashboard.index')->with(compact('orders',"orderscount","Travel","acppetOrder","waitingOrders"));
    }
}
