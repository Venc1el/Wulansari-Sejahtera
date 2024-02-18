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
        $cartItems = session()->get('cart', []);

        $order = new Order([
            'user_id' => $user->id,
            'customer_name' => $user->name,
            'order_date' => now(),
            'total_amount' => 0,
            'shipping_address' => $user->address,

        ]);

        $order->save();

        $totalAmount = 0;
        $totalPriceItems = 0;
        foreach ($cartItems as $cartItem) {
            $orderItem = new OrderItem([
                'order_id' => $order->id,
                'item_id' => $cartItem['id'],
                'quantity' => $cartItem['quantity'],
            ]);

            $orderItem->save();

            $totalPriceForItem = $cartItem['quantity'] * $cartItem['price'];
            $totalAmount += $totalPriceForItem;

            $totalPriceItems += $totalPriceForItem;
        }

        $order->total_amount = $totalAmount;
        $order->save();

        $mailData = [
            'title' => "Halo Wulansari Sejahtera",
            'body'  => "Kami ingin memberi tahu bahwa ada pesanan baru yang masuk ke toko Anda. Berikut adalah detail pesanannya:",
            'order_id' => $order->id,
            'customer_name' => $user->name,
            'customer_email' => $user->email,
            'customer_phone' => $user->phone,
            'customer_address' => $user->address,
            'orderItems' => array_map(function ($cartItem) {
                return [
                    'item_name' => $cartItem['item_name'],
                    'quantity' => $cartItem['quantity'],
                    'price' => $cartItem['price'],
                    'total_price' => $cartItem['price'] * $cartItem['quantity'],
                ];
            }, $cartItems),
            'total_amount' => $totalAmount,
        ];

        Mail::to('sales@wulansarisejahtera.com')->send(new UserDataMail($mailData));

        session()->forget('cart');

        return redirect('/')->with('success', 'Order placed successfully and email sent!');
    }
}
