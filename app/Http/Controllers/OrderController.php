<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric',
        ]);

        $order = Order::create([
            'total_price' => $validated['total_price'],
        ]);

        foreach ($validated['products'] as $product) {
            $order->products()->attach($product['id'], ['quantity' => $product['quantity']]);
        }

        return response()->json(['message' => 'Order placed successfully!', 'order' => $order], 201);
    }
}
