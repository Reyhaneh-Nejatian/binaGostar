<?php


namespace arghavan\RolePermissions\Policies;


use Illuminate\Auth\Access\HandlesAuthorization;
use arghavan\RolePermissions\Models\Permission;
use arghavan\User\Models\User;

class RolePermissionsPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    public function manage(User $user)
    {
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_ROLE_PERMISSION)) return true;

        return false;
    }
}
