<?php

namespace Photogallery\Repositories;

use Photogallery\Models\User;
use Hash;

class UserRepository
{

    public function register($data)
    {
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
