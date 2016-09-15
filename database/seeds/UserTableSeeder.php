<?php

use Illuminate\Database\Seeder;
use PhotoGallery\Models\User;
use PhotoGallery\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'first_name' => env('ADMIN_FIRSTNAME'),
            'last_name' => env('ADMIN_LASTNAME'),
            'email' => env('ADMIN_EMAIL'),
            'password' => bcrypt(env('ADMIN_PASSWORD')),
        ]);
        $roleAdmin = Role::where('name', 'administrator')->first();
        $user->addRole($roleAdmin);
    }
}
