<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\LoginResource;
use App\Repositories\User\UserRepository;
use App\Http\Controllers\Controller;
use JWTAuth;

class UserController extends Controller
{
    protected $model;

    public function __construct(UserRepository $user)
    {
        $this->middleware('jwt.auth');
        $this->model = $user;
    }

    public function create(CreateUserRequest $request)
    {
        $user = $this->model->store($request->all());
        return $this->success(new LoginResource(['token' => JWTAuth::attempt($request->only(['email', 'password'])), 'user' => $user]));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        return $this->success($this->model->updateUser($request->all(), $id));
    }

    public function delete(UpdateUserRequest $request, $id)
    {
        return $this->success($this->model->updateUser($request->all(), $id));
    }

    public function get($id = null)
    {
        return $this->success($this->model->get($id));
    }
}
