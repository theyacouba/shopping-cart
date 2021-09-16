<?php

namespace App\Http\Controllers;

use App\Services\Cart\CartService;

class CartController extends Controller
{
    public function index(CartService $cartService)
    {
        $carts = $cartService->cart();
        $totalPrice = $cartService->totalPrice();
        
        return view('cart.index', [
            'carts' => $carts,
            'totalPrice' => $totalPrice
        ]);
    }

    public function add(int $id, CartService $cartService)
    {
        $cartService->add($id);

        return back();
    }

    public function update(int $id, CartService $cartService)
    {
        $cartService->update($id);

        return back();
    }

    public function remove(int $id, CartService $cartService)
    {

        $cartService->remove($id);
        return back();
        
    }
}
