<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\UpdateUserRequest;
use App\Http\Resources\V1\UserCollection;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
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

        return response(['User has been updated successfully!' => new UserResource($user)]);
    }

    public function destroy($id)
    {
        if ($user = User::find($id)) {
            $user->delete();

            return response([
                'message' => 'User deleted'
            ], Response::HTTP_NO_CONTENT);
        }

        return response(['message' => 'User with id: ' . $id . ' not found!'],
            Response::HTTP_NOT_FOUND);
    }

}
