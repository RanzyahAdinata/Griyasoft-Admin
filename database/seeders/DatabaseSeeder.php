<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(UsersSeeder::class);

        $this->call(RolesTableSeeder::class);
        // $this->call(UsersSeeder::class);
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
