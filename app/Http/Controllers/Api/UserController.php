<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Repositories\User\UserRepository;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
        $this->middleware('guest')->except(['forgot', 'reset']);
    }

    public function create(CreateUserRequest $request)
    {
        return $this->success($this->user->store($request->all()));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        return $this->success($this->user->updateUser($request->all(), $id));
    }

    public function get($id)
    {
        return $this->success($this->user->findOrFail($id));
    }

    public function all()
    {
        return $this->success($this->user->all());
    }

    public function delete($id)
    {
        return $this->success($this->user->deleteUser($id), 'The user was eliminated successfully.');
    }
}
