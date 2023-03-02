<?php


namespace arghavan\ProductImage\Policies;


use Illuminate\Auth\Access\HandlesAuthorization;
use arghavan\RolePermissions\Models\Permission;
use arghavan\User\Models\User;

class ProductImagePolicy
{
    use HandlesAuthorization;

    public function index(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_PRODUCTS_ATTRIBUTE);
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_PRODUCTS_ATTRIBUTE);
    }

    public function edit(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_PRODUCTS_ATTRIBUTE);
    }

    public function delete(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_PRODUCTS_ATTRIBUTE);
    }
}
