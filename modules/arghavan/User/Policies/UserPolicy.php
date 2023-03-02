<?php


namespace arghavan\User\Policies;


use Illuminate\Auth\Access\HandlesAuthorization;
use arghavan\RolePermissions\Models\Permission;

class UserPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    public function index($user)
    {
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_USERS)) return true;

        return false;
    }

    public function edit($user)
    {
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_USERS)) return true;

        return false;
    }

    public function manualVerify($user)
    {
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_USERS)) return true;

        return false;
    }

    public function editProfile($user)
    {
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_USERS)) return true;

        return false;
    }

    public function delete($user)
    {
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_USERS)) return true;

        return false;
    }

}
