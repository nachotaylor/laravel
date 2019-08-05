<?php

namespace App\Repositories\User;

use App\Repositories\Base\BaseRepository;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function store(array $data = [])
    {
        $data['password'] = Hash::make($data['password']);

        return $this->model->create($data);
    }

    public function updateUser(array $data = [], $id)
    {
        $user = $this->findOrFail($id);

        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        return $user;
    }

    public function deleteUser($id)
    {
        $user = $this->findOrFail($id);

        return $user->delete();
    }
}
