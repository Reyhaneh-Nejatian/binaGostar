<?php


namespace arghavan\Product\Policies;


use Illuminate\Auth\Access\HandlesAuthorization;
use arghavan\RolePermissions\Models\Permission;
use arghavan\User\Models\User;

class ProductPolicy
{
    use HandlesAuthorization;

    public function mange(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_PRODUCTS);
    }

    public function index(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_PRODUCTS);
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_PRODUCTS);
    }

    public function edit(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_PRODUCTS);
    }

    public function change_confirmation_status(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_PRODUCTS);
    }

    public function delete(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_PRODUCTS);
    }
}
