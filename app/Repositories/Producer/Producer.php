<?php

namespace App\Repositories\Producer;

use App\Repositories\Base\BaseModel;
use App\Repositories\User\User;

class Producer extends BaseModel
{
    protected $fillable = [
        'user_id',
        'enrollment'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
