<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Validation;
use Helper;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\EmailRequest;
use App\Models\User;


class UsersController extends Controller
{
    function __construct()
    {
    }

    function register(RegisterRequest $request): object
    {
        $token = null;
        $users = $request->only(['name', 'email', 'password']);
        $users['password'] = Helper::generatePassword($users['password']);
        $register = User::create($users);
        if ($register) {
            $token = $register->createToken('auth_token')->plainTextToken;
        }
        $response = Helper::responseApp(data:['token' => $token]);
        return response()->json($response);
    }

    function checkEmail(EmailRequest $request): object
    {
        $email = $request->get('email');
        $checkEmail = User::where('email', $email)->first(['email']);
        if (!$checkEmail) {
            $response = Helper::responseApp(status: 'failed');
        } else {
            $response = Helper::responseApp(data: $checkEmail);
        }
        return response()->json($response);
    }

    function auth(LoginRequest $request): object
    {
        $email = $request->get('email');
        $password = Helper::generatePassword($request->get('password'));
        $checkLogin = User::where('email', $email)->where('password', $password)->first(['id', 'email']);

        if (!$checkLogin) {
            $response = Helper::responseApp(status: 'failed');
        } else {
            $token = $checkLogin->createToken('auth_token')->plainTextToken;
            $response = Helper::responseApp(data: ['token' => $token]);
        }
        return response()->json($response);
    }
}
