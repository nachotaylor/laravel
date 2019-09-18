<?php

namespace App\Repositories\Client;

use App\Repositories\Base\BaseRepository;
use App\Constants\UserType;
use App\Repositories\User\UserRepository;

class ClientRepository extends BaseRepository
{
    protected $model;

    protected $user;

    public function __construct(Client $client, UserRepository $user)
    {
        $this->model = $client;
        $this->user = $user;
    }

    public function store(array $data = [])
    {
        $data['user']['type'] = UserType::CLIENT;
        $user = $this->user->store($data);
        $data['client']['user_id'] = $user->id;
        $client = $this->model->create($data['client']);

        return $client;
    }

    public function updateClient(array $data = [], $id)
    {
        $client = $this->findOrFail($id);
        $client->update($data['client']);
        $this->user->updateUser($data['user'], $client->user_id);

        return $client;
    }

    public function profile($id)
    {
        return $this->model->with('user')->where('id', $id)->first();
    }
}
