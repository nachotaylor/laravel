<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'admin' => [
                'id' => $this['admin']->id,
                'name' => $this['admin']->name,
                'email' => $this['admin']->email,
            ],
            'access_token' => $this['token']
        ];
    }
}
