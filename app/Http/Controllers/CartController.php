<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addItem($id)
    {
        $item = Item::findOrFail($id);
        $cartItems = session()->get('cart', []);

        if (isset($cartItems[$id])) {
            $cartItems[$id]['quantity']++;
        } else {
            $cartItems[$id] = [
                'id' => $item->id,
                'quantity' => 1,
                'image_url' => $item->image,
                'item_name' => $item->item_name,
                'price' => $item->price,
                'weight' => $item->weight,

            ];
        }

        session()->put('cart', $cartItems);
        return response()->json(['message' => 'Item added to cart successfully'], 200);
    }


    public function showCart()
    {
        $cartItems = session()->get('cart', []);
        return view('components.cart-modal', compact('cartItems'));
    }

    public function emptyCart(Request $request)
    {
        session()->flush();
        return redirect()->back()->with('success', 'Cart emptied successfully');
    }

    public function removeItem($id)
    {
        $cartItems = session()->get('cart', []);

        if (isset($cartItems[$id])) {
            unset($cartItems[$id]);
            session()->put('cart', $cartItems);
            return response()->json(['message' => 'Item removed from cart successfully'], 200);
        }

        return response()->json(['message' => 'Item not found in cart'], 404);
    }

    public function updateQuantity(Request $request, $id)
    {
        $cartItems = session()->get('cart', []);

        if (isset($cartItems[$id])) {
            $quantity = $request->input('quantity');
            $cartItems[$id]['quantity'] = $quantity;
            session()->put('cart', $cartItems);
            return response()->json(['message' => 'Quantity updated successfully'], 200);
        }

        return response()->json(['message' => 'Item not found in cart'], 404);
    }

    public function subtotal()
    {
        $cartItems = session()->get('cart', []);
        $subtotal = 0;
        foreach ($cartItems as $itemId => $cartItem) {
            $item = Item::findOrFail($itemId);
            $subtotal += $item->price * $cartItem['quantity'];
        }
        return response()->json(['subtotal' => $subtotal]);
    }
}
