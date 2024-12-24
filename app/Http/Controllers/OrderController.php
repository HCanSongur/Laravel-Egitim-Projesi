<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request) {
        $order = new Order();
        $order->fill($request->all());
        $order->user_id = auth()->check() ? auth()->user()->id : 0;
        $order->total_price = Cart::total();
        $order->payment_method = 'paytr';
        $order->save();

        $items = $books = Cart::content();
        foreach ($items as $item){
            $orderdetail = new OrderDetail();
            $orderdetail->order_id = $order->id;
            $orderdetail->product_id = $item->id;
            $orderdetail->per_price = $item->price;
            $orderdetail->qty = $item->qty;
            $orderdetail->subtotal = $item->price * $item->qty;
            $orderdetail->save();
        }

        Cart::destroy();
        return redirect()->back();

    }
}
