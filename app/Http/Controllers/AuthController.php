<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        return response(new UserResource($user), Response::HTTP_CREATED);
    }
}
