<?php

namespace arghavan\Slider\Policies;

use arghavan\RolePermissions\Models\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;

class SliderPolicy
{
    use HandlesAuthorization;

    public function manage($user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_SLIDER_PERMISSION)) return true;
    }
}
