<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\TravelPackage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TravelPackage $travelPackage): View
    {
        $user = Auth::user();

        $users = [];
        $tourNames = [];
        
        $orders = Order::get();

        foreach ($orders as $order) {
            $user = User::find($order->user_id);
            $users[] = $user;
            $tourName = TravelPackage::find($order->travel_package_id);
            $tourNames[] = $tourName;
        }
    
        $orders = Order::get();

        return view('admin.orders.index')->with(compact('orders','users', 'tourNames'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                "number" => 'required|max:20',
                "address" => 'required|max:255',
                "date" => 'required',
                "phone" => 'required|max:10',
            ],
            [
                "number.required" => 'Số người tham gia phải có ',
                "phone.required" => 'Số điện thoại phải có ',
                "address.required" => 'Địa điểm đón phải có',
                "date.required" => 'Ngày bắt đầu phải có',
            ]
        );
        $dataAll = $request->all();
        $order = new Order();
        $order->user_id = $dataAll["user_id"];
        $order->travel_package_id = $dataAll["travel_package_id"];
        $order->number = $dataAll["number"];
        $order->phone = $dataAll["phone"];
        $order->address = $dataAll["address"];
        $order->date = $dataAll["date"];
        $order->totalPrice = $dataAll["totalPrice"];

        $order->save();

        return redirect()->route('home')->with('message', 'Đặt tour thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $order = Order::find($id);
        $order->status = $data["status"];
        $order->save();

        return redirect()->back()->with('message', 'Cập nhật trạng thái thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);

        $order->delete();

        return redirect()->back()->with('message', 'Xóa order thành công!');
    }
}