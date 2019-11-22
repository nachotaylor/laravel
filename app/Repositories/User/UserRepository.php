<?php

namespace App\Repositories\User;

use App\Repositories\Base\BaseRepository;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Exception;

class UserRepository extends BaseRepository
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function store(array $data = [], $type = null)
    {
        if ($type) {
            $data['type'] = $type;
        }
        $data['password'] = Hash::make($data['password']);

        return $this->model->create($data);
    }

    public function updateUser(array $data = [], $id)
    {
        $user = $this->findOrFail($id);
        $data['password'] ? $data['password'] = Hash::make($data['password']) : 0;
        $user->update($data);

        return $user;
    }

    public function deleteUser($id)
    {
        $user = $this->findOrFail($id);

        return $user->delete();
    }

    public function get($id)
    {
        $query = $this->model;

        return $id ? $query->where('id', $id)->first() : $query->get();
    }

    public function getAll($type)
    {
        return $this->model->whereType($type)->get();
    }

    public function findByEmail($email)
    {
        return $this->model->whereEmail($email)->first();
    }

    public function changePassword($data, $id)
    {
        $user = $this->findOrFail($id);
        $user->password = Hash::make($data['password']);
        $user->save();

        return $user;
    }

    public function sendMail($data)
    {
        $user = $this->model->where('email', $data['email'])->first();
        if ($user) {
            $hash = bcrypt($data['email'] . base64_encode(random_bytes(8)));

            $payload = [
                'name' => $user->name,
                'hash' => $hash
            ];

            $mail = [
                'payload' => $payload,
                'view' => 'recovery',
                'sender' => env('MAIL_ADDRESS'),
                'receiver' => $data['email'],
                'subject' => $user->name . ', reset link password!'
            ];

            DB::table('password_resets')->insert([
                'email' => $data['email'],
                'token' => $hash,
                'created_at' => new DateTime(null, new DateTimeZone(env('TIME_ZONE')))
            ]);

            if (env('MAIL_ENABLED')) {
                MailHelper::send($mail);
            }
            return ['token' => $hash];

        }
        throw new Exception('Correo electrónico incorrecto.');
    }

    public function resetPassword($data)
    {
        $date = DB::table('password_resets')->select('created_at')->where('token', $data['reset_token'])->first();
        if ($date) {
            $dateTime = new DateTime($date->created_at, new DateTimeZone(env('TIME_ZONE')));
            $dateTime->modify('+1 day');
            $person = DB::table('password_resets')
                ->select('email')
                ->where('token', $data['reset_token'])
                ->whereDate('created_at', '<=', $dateTime->format('Y-m-d H:i:s'))
                ->first();
            if ($person) {
                $user = $this->model->where('email', $person->email)->first();
                $user->password = Hash::make($data['password']);
                $user->save();
                DB::table('password_resets')->where('token', $data['reset_token'])->delete();

                return $user;
            }
            throw new Exception('Token expirado.');
        }
        throw new Exception('Token inválido.');
    }
}
