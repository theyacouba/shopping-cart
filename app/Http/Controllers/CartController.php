<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cart = $request->session()->get('cart');

        $carts = [];

        foreach ($cart as $product => $quantity) {
            $carts[] = [
                'product' => Product::find($product),
                'quantity' => $quantity
            ];
        }

        $total = 0;

        foreach ($carts as $cart) {
            $total += $cart['quantity'] * $cart['product']->price;
        }

        return view('cart.index', [
            'carts' => $carts,
            'total' => $total
        ]);
    }

    public function add(int $id, Request $request)
    {
        $cart = $request->session()->get('cart', []);

        if(!empty($cart[$id])){
            $cart[$id]++;
        }else {
            $cart[$id] = 1;
        }

        $request->session()->put('cart', $cart);

        return back();
    }

    public function update(int $id, Request $request)
    {
        if($request->quantity <= 0) {
            return back();
        }
        
        $request->validate([
            'quantity' => 'required|integer'
        ]);

        $cart = $request->session()->get('cart');
        

        $cart[$id] = intval($request->quantity);

        $request->session()->put('cart', $cart);

        return back();
    }

    public function remove(int $id, Request $request)
    {
        $cart = $request->session()->get('cart');

        unset($cart[$id]);

        $request->session()->put('cart', $cart);

        return back();

    }
}
