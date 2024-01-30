<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Item;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\UserDataMail;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        $user = Auth::user();
        $itemId = $request->input('item_id');

        $order = new Order([
            'user_id' => $user->id,
            'customer_name' => $user->name,
            'order_date' => now(),
            'total_amount' => 0,
            'shipping_address' => 'Jl.Indramayu Selatan no 12',
        ]);

        $order->save();

        $orderItem = new OrderItem([
            'order_id' => $order->id,
            'item_id' => $itemId,
            'quantity' => rand(1, 5),
        ]);

        $orderItem->save();

        $order->total_amount = $order->orderItems->sum(function ($orderItem) {
            return $orderItem->quantity * $orderItem->item->price;
        });

        $order->save();

        $mailData = [
            'title' => "Halo Wulansari Sejahtera ",
            'body'  => "Kami ingin memberi tahu bahwa ada pesanan baru yang masuk ke toko Anda. Berikut adalah detail pesanannya:",
            'order_id' => $order->id,
            'customer_name' => $user->name,
            'customer_email' => $user->email,
            'orderItems' => $order->orderItems->map(function ($orderItem) {
                return [
                    'item_name' => $orderItem->item->item_name,
                    'quantity' => $orderItem->quantity,
                    'price' => $orderItem->item->price,
                ];
            })->toArray(),
            'total_amount' => $order->total_amount,
        ];

        Mail::to('wulansarisejahtera613@gmail.com')->send(new UserDataMail($mailData));

        return redirect('/')->with('success', 'Order placed successfully and email sent!');
    }
}
