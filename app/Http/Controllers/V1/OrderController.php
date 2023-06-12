<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreOrderRequest;
use App\Http\Requests\V1\UpdateOrderRequest;
use App\Http\Resources\V1\OrderCollection;
use App\Http\Resources\V1\OrderResource;
use App\Models\Order;
use App\Models\User;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    public function index()
    {
        return new OrderCollection(Order::filter()->paginate());
    }

    public function show(Order $order)
    {
        return new OrderResource($order);
    }

    public function store(StoreOrderRequest $request)
    {
        return (new OrderService())->makeOrder($request);
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->update($request->all());
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return response([
            'message' => ''
        ], Response::HTTP_NO_CONTENT);
    }

    public function cancelOrder(Order $order)
    {
        $cancelledOrder = (new OrderService())->cancelOrder($order);

        return response(['message' => 'Successfully canceled order!'], Response::HTTP_OK);
    }

    public function payForOrder(Order $order)
    {
        $cancelledOrder = (new OrderService())->payForOrder($order);

        return response(['message' => 'Thanks for paying!'], Response::HTTP_OK);
    }

    public function getAllOrdersToSend(User $user)
    {
        return (new OrderService())->getAllOrdersToSend($user);
    }

}
