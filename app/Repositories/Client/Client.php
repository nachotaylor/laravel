<?php

namespace App\Repositories\Client;

use App\Repositories\Base\BaseModel;
use App\Repositories\User\User;

class Client extends BaseModel
{
    protected $fillable = [
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
