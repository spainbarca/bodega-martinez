<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

class OrderController2 extends Controller
{

    public function index(){

        $orders = Order::query()->where('user_id', auth()->user()->id);

        if (request('status')) {
            $orders->where('status', request('status'));
        }

        $orders = $orders->orderByDesc('id')->forPage(1, 30)->get();


        $pendiente = Order::where('status', 1)->where('user_id', auth()->user()->id)->count();
        $recibido = Order::where('status', 2)->where('user_id', auth()->user()->id)->count();
        $fiado = Order::where('status', 3)->where('user_id', auth()->user()->id)->count();
        $entregado = Order::where('status', 4)->where('user_id', auth()->user()->id)->count();
        $anulado = Order::where('status', 5)->where('user_id', auth()->user()->id)->count();


        return view('orders.indexall', [
            'orders' => Order::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->paginate(20),
        ]);
    }

    public function show(Order $order){

        $this->authorize('author', $order);

        $items = json_decode($order->content);
        $envio = json_decode($order->envio);

        return view('orders.show', compact('order', 'items', 'envio'));
    }


    public function pay(Order $order, Request $request){

        $this->authorize('author', $order);

        $payment_id = $request->get('payment_id');

        $response = Http::get("https://api.mercadopago.com/v1/payments/$payment_id" . "?access_token=APP_USR-7537630218290891-080504-1c7fc3ec37d721799182a10d91ad68bf-802453379");

        $response = json_decode($response);

        $status = $response->status;

        if($status == 'approved'){
            $order->status = 2;
            $order->save();
        }

        return redirect()->route('orders.show', $order);
    }
}
