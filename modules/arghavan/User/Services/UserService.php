<?php


namespace arghavan\User\Services;


use arghavan\User\Repositories\UserRepo;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public static function changePassword($email,$newPassword)
    {
        $user = (new UserRepo())->findByEmail($email);
        $user->password = Hash::make($newPassword);
        $user->save();
    }
}
