<?php

use App\Repositories\User\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Producer\Producer;

class ProducerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'email' => 'producer@admin.com',
            'password' => Hash::make('admin'),
            'name' => 'Producer'
        ]);

        Producer::create([
            'user_id' => $user->id,
            'enrollment' => 'MT' . random_int(4, 5)
        ]);
    }
}
