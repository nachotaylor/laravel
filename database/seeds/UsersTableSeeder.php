<?php

use App\Constants\UserType;
use App\Repositories\User\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'name' => 'Admin',
            'type' => UserType::ADMIN
        ]);
    }
}
