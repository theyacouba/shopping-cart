<?php

namespace App\Services\Cart;

use App\Models\Product;
use Illuminate\Http\Request;

class CartService
{
    public function __construct(
        public Request $request
    )
    {}
    
    public function cart(): array
    {
        $cart = $this->request->session()->get('cart');

        $carts = [];

        foreach ($cart as $product => $quantity) {
            $carts[] = [
                'product' => Product::find($product),
                'quantity' => $quantity
            ];
        }
        return $carts;
    }
    public function add(int $id): void
    {
        $cart = $this->request->session()->get('cart', []);

        if(!empty($cart[$id])){
            $cart[$id]++;
        }else {
            $cart[$id] = 1;
        }

        $this->request->session()->put('cart', $cart);
    }
    public function update(int $id)
    {
        if($this->request->quantity <= 0) {
            return back();
        }

        $this->request->validate([
            'quantity' => 'required|integer'
        ]);

        $cart = $this->request->session()->get('cart');
        

        $cart[$id] = intval($this->request->quantity);

        $this->request->session()->put('cart', $cart);
    }
    public function totalPrice(): float
    {
        $totalPrice = 0;

        foreach ($this->cart() as $cart) {
            $totalPrice += $cart['quantity'] * $cart['product']->price;
        }
        
        return $totalPrice;
    }
    public function remove(int $id): void
    {
        $cart = $this->request->session()->get('cart');

        unset($cart[$id]);

        $this->request->session()->put('cart', $cart);
    }
}