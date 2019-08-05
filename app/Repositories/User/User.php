<?php

namespace App\Repositories\User;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
        'password',
        'remember_token',
        'email_verified_at'
    ];
}
