<?php

use Illuminate\Database\Seeder;
use PhotoGallery\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'administrator'
        ]);
        
        Role::create([
            'name' => 'superuser'
        ]);
        
        Role::create([
            'name' => 'editor'
        ]);

        Role::create([
            'name' => 'user'
        ]);
    }
}
