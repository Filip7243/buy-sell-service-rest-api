<?php

namespace App\Services;

use App\Http\Resources\V1\OrderCollection;
use App\Http\Resources\V1\ProductCollection;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserService
{
    public function findUserOrders(User $user) : OrderCollection
    {
        return new OrderCollection($user->orders);
    }

    public function findUserProducts(User $user) : ProductCollection
    {
        $userProducts = DB::table('products')
            ->selectRaw('*')
            ->where('user_id', $user->id)
            ->get();

        return new ProductCollection($userProducts);
    }
}
