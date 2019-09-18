<?php

namespace App\Http\Controllers\Api;

use App\Repositories\User\UserRepository;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    protected $model;

    public function __construct(UserRepository $user)
    {
        $this->middleware('jwt.auth');
        $this->model = $user;
    }
}
