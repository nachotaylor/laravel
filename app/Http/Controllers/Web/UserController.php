<?php

namespace App\Http\Controllers\Web;

use App\Constants\UserType;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Repositories\User\UserRepository;
use App\Http\Controllers\Controller;
use Exception;

class UserController extends Controller
{
    protected $model;

    public function __construct(UserRepository $user)
    {
        $this->model = $user;
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.index', ['users' => $this->model->getAll(UserType::ADMIN)]);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        try {
            $this->model->updateUser($request->all(), $id);
            return redirect()->back()->with('message', 'Usuario modificado.');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function create(CreateUserRequest $request)
    {
        try {
            $this->model->store($request->all(), UserType::ADMIN);
            return redirect()->back()->with('message', 'Usuario creado.');
        } catch (Exception $exception) {
            dd($exception->getMessage());
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $this->model->deleteUser($id);
            return redirect()->back()->with('message', 'Usuario eliminado.');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
