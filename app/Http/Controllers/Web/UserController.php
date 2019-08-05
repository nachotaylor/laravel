<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Repositories\User\UserRepository;
use App\Http\Controllers\Controller;
use Exception;

class UserController extends Controller
{
    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
        $this->middleware('auth');
    }

    public function index()
    {
        return view('user.index', ['users' => $this->user->all()]);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        try {
            $this->user->updateUser($request->all(), $id);
            return redirect('user/index')->with('message', 'Usuario modificado.');
        } catch (Exception $exception) {
            return redirect('user/index')->with('error', $exception->getMessage());
        }
    }

    public function create(CreateUserRequest $request)
    {
        try {
            $this->user->store($request->all());
            return redirect('user/index')->with('message', 'Usuario creado.');
        } catch (Exception $exception) {
            return redirect('user/index')->with('error', $exception->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $this->user->deleteUser($id);
            return redirect()->back()->with('message', 'Usuario eliminado.');
        } catch (Exception $exception) {
            return redirect('user/index')->with('error', $exception->getMessage());
        }
    }
}
