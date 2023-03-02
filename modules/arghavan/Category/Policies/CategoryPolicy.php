<?php


namespace arghavan\Category\Policies;


use Illuminate\Auth\Access\HandlesAuthorization;
use arghavan\RolePermissions\Models\Permission;
use arghavan\User\Models\User;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    public function manage(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_CATEGORY);
    }
}
