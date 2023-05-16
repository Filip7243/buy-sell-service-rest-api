<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreOrderRequest;
use App\Http\Requests\V1\UpdateOrderRequest;
use App\Http\Resources\V1\OrderCollection;
use App\Http\Resources\V1\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    public function index()
    {
        return new OrderCollection(Order::paginate());
    }

    public function show(Order $order)
    {
        return new OrderResource($order);
    }

    public function store(StoreOrderRequest $request)
    {
        return new OrderResource(Order::create($request->all()));
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->update($request->all());
    }

    public function destroy($id)
    {
        if ($foundOrder = Order::find($id)) {
            $foundOrder->delete();

            return response([
                'message' => 'Order: ' . $foundOrder->name . ' deleted'
            ], Response::HTTP_NO_CONTENT);
        }

        return response(['message' => 'Order: ' . $id . ' not found!'],
            Response::HTTP_NOT_FOUND);
    }

}
