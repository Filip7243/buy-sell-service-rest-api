<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\LoginRequest;
use App\Http\Requests\V1\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    public function register(RegisterRequest $request)
    {
        $basicRoles = [1, 2];  // 1 - guest, 2 - user

        $user = new User();

        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->phone_number = $request->input('phone_number');
        $user->country = $request->input('country');
        $user->postal_code = $request->input('postal_code');
        $user->city = $request->input('city');
        $user->street = $request->input('street');
        $user->house_number = $request->input('house_number');
        $user->flat_number = $request->input('flat_number');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));

        $user->save();

        $user->roles()->attach($basicRoles);

        return $user;

//        return User::create([
//            'first_name' => $request->input('first_name'),
//            'last_name' => $request->input('last_name'),
//            'email' => $request->input('email'),
//            'password' => Hash::make($request->input('password'))
//        ]);
    }

    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response([
                'message' => 'Invalid Credentials'
            ], Response::HTTP_UNAUTHORIZED);  // 401
        }

        $user = Auth::user();
        $roles = $user->roles;
        $token = null;

        foreach ($roles as $role) {
            // TODO: improve roles by specific models in future
            if ($role->name === 'admin') {
                $token = $user->createToken('jwt',
                    ['user:create', 'user:read', 'user:update', 'user:delete',
                        'product:read', 'product:delete',
                        'order:read', 'order:delete',
                        'category:create', 'category:read', 'category:delete',
                        'role:create', 'role:read', 'role:update', 'role:delete']);
                break;
            }

            if ($role->name === 'user') {
                $token = $user->createToken('jwt',
                    ['user:read', 'user:update',
                        'product:create', 'product:read', 'product:update', 'product:delete',
                        'order:create', 'order:read', 'order:delete']);
            }
        }

        $token = $token->plainTextToken;

        $cookie = cookie('token-cookie', $token, 60 * 24); // valid for 1 day

        return response([
            'message' => 'Successfully logged in!'
        ])->withCookie($cookie);
    }

    public function logout()
    {
        $cookie = Cookie::forget('token-cookie');

        return response([
            'message' => 'Successfully logout!'
        ])->withCookie($cookie);
    }

    public function user()
    {
        return Auth::user(); // authenticated user
    }
}
