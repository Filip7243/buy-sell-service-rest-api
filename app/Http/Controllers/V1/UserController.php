<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\UpdateUserRequest;
use App\Http\Resources\V1\UserCollection;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use App\Services\UserService;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function index()
    {
        return new UserCollection(User::filter()->paginate());
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());

        return response([
            'message' => 'User has been successfully updated!'
        ], Response::HTTP_OK);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response([
            'message' => ''
        ], Response::HTTP_NO_CONTENT);
    }

    public function getUserOrders(User $user)
    {
        return (new UserService())->findUserOrders($user);
    }
}
