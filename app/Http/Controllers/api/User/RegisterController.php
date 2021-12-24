<?php

namespace App\Http\Controllers\api\User;

use App\Http\Requests\api\User\UserRegisterRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function register(UserRegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('email')),
        ]);

        return [
            'status' => true,
            'message' => trans('api.user.register.success'),
            'token' => $user->createToken('create')->accessToken
        ];
    }
}
