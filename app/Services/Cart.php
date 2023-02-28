<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

class Cart
{
    public function __construct()
    {
        if (!Session::has('cart')) {
            Session::put('cart', []);
        }
    }

    public function add($id, $product_id, $price, $quantity = 1)
    {
        $cart = Session::get('cart');
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                'product_id' => $product_id,
                'price' => $price,
                'quantity' => $quantity
            ];
        }
        Session::put('cart', $cart);
        $cart = \App\Models\Cart::create([
            'session_id' => \session()->getId(),
            'product_id' => $cart[$id]['product_id'],
            'price' => $cart[$id]['price'],
            'quantity' => $cart[$id]['quantity']
        ]);
        $cart->save();
    }

    public function update($id, $quantity)
    {
        $cart = Session::get('cart');
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $quantity;
            Session::put('cart', $cart);
        }
    }

    public function remove($id)
    {
        $cart = Session::get('cart');
        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }
    }

    public function clear()
    {
        Session::forget('cart');
    }

    public function items()
    {
        return Session::get('cart');
    }

    public function count()
    {
        $cart = Session::get('cart');
        return count($cart);
    }

    public function total()
    {
        $cart = Session::get('cart');
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

}
