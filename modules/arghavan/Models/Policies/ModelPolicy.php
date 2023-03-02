<?php


namespace arghavan\Models\Policies;


use Illuminate\Auth\Access\HandlesAuthorization;
use arghavan\RolePermissions\Models\Permission;
use arghavan\User\Models\User;

class ModelPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    public function manage(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_BRAND_PERMISSION);
    }
}
