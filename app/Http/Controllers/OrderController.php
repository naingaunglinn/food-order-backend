<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->all();
        DB::beginTransaction();
        try {
            $order = Order::create([
                'total_price' => $validated['total_price'],
            ]);

            foreach ($validated['products'] as $product) {
                $item = Product::findOrFail($product['id']);

                if ($item->stock < $product['quantity']) {
                    throw new Exception("Insufficient stock for item ID {$product['id']}");
                }

                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $product['id'],
                    'quantity' => $product['quantity'],
                    'price' => $product['quantity'] * $item->price,
                ]);

                $item->decrement('stock', $product['quantity']);
            }

            DB::commit();

            return response()->json(['message' => 'Order placed successfully', 'order' => $order], 201);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
