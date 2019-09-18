<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\User\LoginRequest;
use App\Http\Resources\LoginResource;
use App\Repositories\User\UserRepository;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    protected $model;

    public function __construct(UserRepository $user)
    {
        $this->middleware('jwt.auth', ['except' => ['login', 'forgot', 'reset']]);
        $this->model = $user;
    }

    public function login(LoginRequest $request)
    {
        if (!$token = JWTAuth::attempt($request->only(['email', 'password']))) {
            throw new Exception('Invalid Credentials.', 1);
        }
        return $this->success(new LoginResource(['token' => $token, 'admin' => auth()->user()]));
    }

    public function logout()
    {
        auth()->logout();
        return $this->success([], 'Logged out Successfully.');
    }

    public function change(Request $request)
    {
        return $this->success($this->model->changePassword($request->all(), auth()->user()->id), 'Contraseña modificada.');
    }

    public function forgot(Request $request)
    {
        return $this->success($this->model->sendMail($request->only('email')), 'Link de recuperación enviado.');
    }

    public function reset(LoginRequest $request)
    {
        return $this->success($this->model->resetPassword($request->all()), 'Contraseña reseteada.');
    }
}