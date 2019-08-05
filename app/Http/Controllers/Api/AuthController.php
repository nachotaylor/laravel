<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\User\LoginRequest;
use App\Http\Resources\LoginResource;
use App\Repositories\User\UserRepository;
use App\Http\Controllers\Controller;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
        $this->middleware('guest', ['except' => ['login']]);
    }

    public function login(LoginRequest $request)
    {
        if (!$token = JWTAuth::attempt($request->only(['email', 'password']))) {
            throw new Exception('Invalid Credentials.', 1);
        }
        return $this->success(new LoginResource(['token' => $token, 'user' => auth()->user()]));
    }

    public function logout()
    {
        auth()->logout();
        return $this->success([], 'Logged out Successfully.');
    }
}