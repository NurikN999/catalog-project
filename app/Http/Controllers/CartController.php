<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    protected $cartService;

    public function __construct(\App\Services\Cart $cartService)
    {
        $this->cartService = $cartService;
    }


    public function store(Request $request)
    {
        $this->cartService->add(session()->getId(), $request->input('product_id'), 12333);
        return response()->json([
            'message' => 'Added successfully'
        ]);
    }

    public function show()
    {
        return response()->json($this->cartService->items());
    }

}
