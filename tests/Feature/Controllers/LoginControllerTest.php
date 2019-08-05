<?php

namespace Tests\Feature\Controllers;

use Tests\FeatureTestCase;


class AuthControllerTest extends FeatureTestCase
{
    public function test_a_user_can_login()
    {
        $user = $this->createUser([
            'email' => 'test@admin.com'
        ]);

        $this
            ->doPost(route('api::auth::login'), [
                'email' => $user->email,
                'password' => 'admin'
            ])
            ->assertStatus(200)
            ->assertJson([
                "status" => "success",
            ]);
    }

    public function test_a_user_cannot_login_with_wrong_email()
    {
        $this
            ->doPost(route('api::auth::login'), [
                'email' => 'fake@admin.com',
                'password' => 'secret'
            ])
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "email" => [
                        "The selected email is invalid."
                    ]
                ]]);
    }

    public function test_a_user_cannot_login_with_wrong_password()
    {
        $this
            ->doPost(route('api::auth::login'), [
                'email' => 'admin@admin.com',
                'password' => 'secret'
            ])
            ->assertStatus(400)
            ->assertJson([
                "status" => "error",
                "messages" => "Invalid Credentials."
            ]);
    }

    public function test_a_user_can_logout()
    {
        $user = $this->createUser();

        $this
            ->actingAsJWT($user)
            ->doPost(route('api::auth::logout'))
            ->assertStatus(200)
            ->assertJson([
                "status" => "success",
                "data" => [],
                "message" => "Logged out Successfully."
            ]);
    }
}
