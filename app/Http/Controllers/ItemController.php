<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function index(){
        $items = Item::all();
        $cartItems = session()->get('cart', []);
        return view('welcome', compact('cartItems','items'));
    }
}
