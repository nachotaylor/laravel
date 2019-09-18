<?php

namespace App\Repositories\Producer;

use App\Repositories\Base\BaseRepository;
use App\Repositories\User\UserRepository;
use App\Constants\UserType;

class ProducerRepository extends BaseRepository
{
    protected $model;

    protected $user;

    public function __construct(Producer $producer, UserRepository $user)
    {
        $this->model = $producer;
        $this->user = $user;
    }

    public function store(array $data = [])
    {
        $data['user']['type'] = UserType::PRODUCER;
        $user = $this->user->store($data);
        $data['producer']['user_id'] = $user->id;
        $producer = $this->model->create($data['producer']);

        return $producer;
    }

    public function updateProducer(array $data = [], $id)
    {
        $producer = $this->findOrFail($id);
        $producer->update($data['producer']);
        $this->user->updateUser($data['user'], $producer->user_id);

        return $producer;
    }

    public function profile($id)
    {
        return $this->model->with('user')->where('id', $id)->first();
    }
}
