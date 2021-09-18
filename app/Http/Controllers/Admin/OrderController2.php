<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController2 extends Controller
{
    public function index(){

        $orders = Order::query()->where('status', '<>', 1);

        if (request('status')) {
            $orders->where('status', request('status'));
        }

        return view('admin.orders.indexall',
            [
                'orders' => Order::orderBy('id', 'desc')->paginate(20),
            ]);
    }

    public function show(Order $order){
        return view('admin.orders.show', compact('order'));
    }
}
