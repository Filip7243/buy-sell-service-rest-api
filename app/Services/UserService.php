<?php

namespace App\Services;

use App\Models\User;

class UserService
{

    public function findUserOrders(User $user)
    {
        return $user->order;
    }
}
