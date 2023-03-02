<?php


namespace arghavan\RolePermissions\Models;

class Permission extends \Spatie\Permission\Models\Permission
{
    const PERMISSION_MANAGE_USERS = 'manage users';
    const PERMISSION_MANAGE_PRODUCTS = 'manage products';
    const PERMISSION_MANAGE_PRODUCTS_ATTRIBUTE = 'manage products attribute';
    const PERMISSION_MANAGE_CATEGORY = 'manage category';
    const PERMISSION_MANAGE_ROLE_PERMISSION = 'manage role_permissions';
    const PERMISSION_MANAGE_SLIDER_PERMISSION = 'manage sliders';
    const PERMISSION_MANAGE_BRAND_PERMISSION = 'manage brands';
    const PERMISSION_MANAGE_PAYMENTS = 'manage payments';
    const PERMISSION_SUPER_ADMIN = 'super admin';

    static $permissions = [
        self::PERMISSION_SUPER_ADMIN,
        self::PERMISSION_MANAGE_USERS,
        self::PERMISSION_MANAGE_ROLE_PERMISSION,
        self::PERMISSION_MANAGE_CATEGORY,
        self::PERMISSION_MANAGE_PRODUCTS,
        self::PERMISSION_MANAGE_SLIDER_PERMISSION,
        self::PERMISSION_MANAGE_BRAND_PERMISSION,
        self::PERMISSION_MANAGE_PRODUCTS_ATTRIBUTE,
        self::PERMISSION_MANAGE_PAYMENTS,
    ];

}
