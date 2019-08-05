<?php

namespace Tests\Feature\Controllers;

use App\Repositories\User\User;
use Tests\FeatureTestCase;

class UserControllerTest extends FeatureTestCase
{
    public function test_create_user()
    {
        $response = $this->doPost(route('api::user::create'), [
            "name" => "admin",
            "email" => "test@admin.com",
            "password" => "admin"
        ]);

        $user = User::all()->last();

        $response->assertStatus(200)->assertJson([
            "status" => "success",
            "data" => [
                "name" => $user->name,
                "email" => $user->email,
                "id" => $user->id
            ]
        ]);
    }

    public function test_create_exist_user()
    {
        $response = $this->doPost(route('api::user::create'), [
            "name" => "admin",
            "email" => "admin@admin.com",
            "password" => "admin"
        ]);

        $response->assertStatus(422)->assertJson([

            "message" => "The given data was invalid.",
            "errors" => [
                "email" => [
                    "The email has already been taken."
                ]
            ]

        ]);
    }

    public function test_update_user()
    {
        $user = $this->createUser();

        $response = $this->actingAsJWT($user)->doPut(route('api::user::update', $user->id), [
            'name' => $user->name,
            'email' => $user->email
        ]);

        $user = $user->fresh();

        $response
            ->assertStatus(200)
            ->assertJson([
                "status" => "success",
                "data" => [
                    "id" => $user->id,
                    "name" => $user->name,
                    "email" => $user->email
                ]
            ]);
    }

    public function test_get_user()
    {
        $user = User::first();

        $response = $this->actingAsJWT($user)->doGet(route('api::user::get', $user->id));

        $response
            ->assertStatus(200)
            ->assertJson([
                "status" => "success",
                "data" => [
                    "id" => $user->id,
                    "name" => $user->name,
                    "email" => $user->email
                ]
            ]);
    }

    public function test_get_all_user()
    {
        $user = User::first();

        for ($i = 0; $i < 5; $i++) {
            $this->createUser();
        }

        $response = $this->actingAsJWT($user)->doGet(route('api::user::all'));

        $response
            ->assertStatus(200)
            ->assertJson([
                "status" => "success",
                "data" => User::get(['id', 'name', 'email'])->toArray()
            ]);
    }

    public function test_delete_user()
    {
        $user = $this->createUser();

        $this
            ->actingAsJWT($user)
            ->doDelete(route('api::user::delete', $user->id))
            ->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'data' => true,
                'message' => 'The user was eliminated successfully.',
            ]);
    }

    public function test_delete_user_wrong_id()
    {
        $user = $this->createUser();

        $this
            ->actingAsJWT($user)
            ->doDelete(route('api::user::delete', 0))
            ->assertStatus(404)
            ->assertJson([
                'status' => 'error',
                'message' => 'User not found',
            ]);
    }
}
