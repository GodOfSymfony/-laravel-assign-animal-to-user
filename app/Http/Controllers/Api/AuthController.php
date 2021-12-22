<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
    {
        $user = User::create(
            $request->only('name', 'email')
            + [
                'password' => Hash::make($request->input('password'))
            ]
        );

        return response('Registered', Response::HTTP_CREATED);
    }

    public function login(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
    {
        if (!Auth::attempt(request()->only('email', 'password'))) {
            return response(['error' => 'Invalid credentials'], Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();
        $jwt = $user?->createToken('token')->plainTextToken;
        $cookie = cookie('jwt', $jwt, 60 * 24);

        return response($jwt, Response::HTTP_OK)->withCookie($cookie);
    }

    public function user(Request $request): mixed
    {
        return new UserResource($request->user());
    }

    public function logout(Request $request): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
    {
        $cookie = cookie()->forget('jwt');
        $request->user()->currentAccessToken()->delete();

        return response('Logout success', Response::HTTP_OK)->withCookie($cookie);
    }
}
