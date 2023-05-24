<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Http\Requests\V1\StoreOrderRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PHPUnit\Exception;
use Symfony\Component\HttpFoundation\Response;

class OrderService
{
    public function makeOrder(StoreOrderRequest $request)
    {
        try {
            $imgName = Str::random(32) . '.' . $request->image->getClientOriginalExtension();
            $product = Product::findOrFail($request->product_id);
            if ($product->quantity >= $request->quantity) {
                Order::create([
                    'price' => $request->quantity * $product->price,
                    'quantity' => $request->quantity,
                    'order_status' => $request->order_status,
                    'product_id' => $request->product_id,
                    'user_id' => $request->user_id,
                ]);
                Storage::disk('public')->put($imgName, file_get_contents($request->image));
                $product->update(['quantity' => $product->quantity - $request->quantity]);

                return response()->json(['message' => 'Successfully added new product!'], Response::HTTP_CREATED);
            }

            return response()->json(['message' => 'You tried to choose too many items'], Response::HTTP_CONFLICT);
        } catch (Exception $e) {
            return response()->json(['message' => 'Something went wrong!'], Response::HTTP_CONFLICT);
        }
    }

    public function cancelOrder(Order $order)
    {
        $order->order_status = OrderStatus::CANCELED;
        $order->save();

        $product = Product::find($order->product_id);
        $product->quantity = $product->quantity + $order->quantity;
        $product->save();

        return $order;
    }

    public function payForOrder(Order $order)
    {
        $order->order_status = OrderStatus::PAID;
        $order->save();

        return $order;
    }
}
