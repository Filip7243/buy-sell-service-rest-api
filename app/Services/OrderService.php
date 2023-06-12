<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Http\Requests\V1\StoreOrderRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PHPUnit\Exception;
use Symfony\Component\HttpFoundation\Response;

class OrderService
{
    public function makeOrder(StoreOrderRequest $request)
    {
        try {
            $product = Product::findOrFail($request->product_id);
            if ($product->quantity >= $request->quantity && $product->quantity != 0 && $request->quantity != 0) {
                Order::create([
                    'price' => $request->quantity * $product->price,
                    'quantity' => $request->quantity,
                    'order_status' => OrderStatus::NOT_PAID,
                    'product_id' => $request->product_id,
                    'user_id' => $request->user_id,
                ]);
                $product->update(['quantity' => $product->quantity - $request->quantity]);
                $product->save();

                return response()->json(['message' => 'Order made successfully'], Response::HTTP_CREATED);
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

    public function getAllOrdersToSend(User $user)
    {
        // SELECT * FROM orders o JOIN products p ON p.id = o.product_id WHERE p.user_id = user->id AND o.order_status = PAID
        $ordersToSend = DB::table('orders')
            ->join('products', 'products.id', '=', 'orders.product_id')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->select('orders.id', 'orders.price', 'orders.quantity', 'products.name',
                'users.first_name', 'users.last_name', 'users.city', 'users.country', 'users.postal_code', 'users.street', 'users.house_number', 'users.flat_number')
            ->where('products.user_id', '=', $user->id)
            ->where('orders.order_status', '=', OrderStatus::PAID)
            ->get();
        return $ordersToSend;
    }
}
