<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'name' => 'Adhipuspo',
            'email' => 'adhi@gmail.com',
            'password' => bcrypt('adhi123'),
            'profile_image' => 'logo.jpg',
            'role_id' => 1,
        ]);

        User::create([
            'name' => 'Ranzyah',
            'email' => 'adinata@gmail.com',
            'password' => bcrypt('adinata123'),
            'profile_image' => 'logo.jpg',
            'role_id' => 1,
        ]);

        User::create([
            'name' => 'syarif',
            'email' => 'syarif@gmail.com',
            'password' => bcrypt('syarif123'),
            'profile_image' => 'logo.jpg',
            'role_id' => 2,
        ]);
    }
}
