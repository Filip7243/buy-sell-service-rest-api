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

        $user->first_name =  $request->input('first_name');
        $user->last_name =  $request->input('last_name');
        $user->email =  $request->input('email');
        $user->password =  $request->input('password');

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

        $token = $user->createToken('jwt')->plainTextToken;
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
