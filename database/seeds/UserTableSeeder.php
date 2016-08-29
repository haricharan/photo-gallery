<?php

use Illuminate\Database\Seeder;
use PhotoGallery\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'Hari',
            'last_name' => 'Padmanaban',
            'email' => 'hari.jan20@gmail.com',
            'password' => bcrypt('password'),
        ]);
    }
}
