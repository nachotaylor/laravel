<?php

namespace Tests;

use App\Repositories\User\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use \Tymon\JWTAuth\Facades\JWTAuth;

class FeatureTestCase extends TestCase
{
    use DatabaseTransactions;

    /**
     * Make a post request.
     *
     * @param $url
     * @param array $attributes
     *
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    public function doPost($url, $attributes = [])
    {
        return $this->json('POST', $url, $attributes);
    }

    /**
     * Make a put request.
     *
     * @param $url
     * @param array $attributes
     *
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    public function doGet($url, $attributes = [])
    {
        return $this->json('GET', $url, $attributes);
    }

    /**
     * Make a put request.
     *
     * @param $url
     * @param array $attributes
     *
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    public function doPut($url, $attributes = [])
    {
        return $this->json('PUT', $url, $attributes);
    }

    /**
     * Make a delete request.
     *
     * @param $url
     *
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    public function doDelete($url)
    {
        return $this->json('DELETE', $url);
    }

    /**
     * Create a user.
     *
     * @param array $attributes
     *
     * @return mixed
     */
    public function createUser($attributes = [])
    {
        return factory(User::class)->create($attributes);
    }

    /**
     * Overwrite the actingAs method to include the JSON WEB TOKEN.
     *
     * @param User $user
     * @param null $driver
     *
     * @return $this
     */
    public function actingAsJWT(User $user, $driver = null)
    {
        $token = JWTAuth::fromUser($user);
        $this->withHeader('Authorization', 'Bearer ' . $token);
        return $this;
    }
}
