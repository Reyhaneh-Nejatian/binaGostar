<?php

namespace arghavan\User\Database\Seeders;

use Illuminate\Database\Seeder;
use arghavan\User\Models\User;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{

    public function run()
    {
        foreach (User::$defultUser as $user)
        {
            User::firstOrCreate(
                ['email' => $user['email']]
                ,[
                    'email' => $user['email'],
                    'name' => $user['name'],
                    'password' => Hash::make($user['password']),
                ]
            )->assignRole($user['role'])->markEmailAsVerified();
        }
    }
}
