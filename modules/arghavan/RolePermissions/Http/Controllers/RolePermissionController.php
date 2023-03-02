<?php

namespace arghavan\RolePermissions\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use arghavan\RolePermissions\Http\Requests\RoleRequest;
use arghavan\RolePermissions\Http\Requests\RoleUpdateRequest;
use arghavan\RolePermissions\Models\Role;
use arghavan\RolePermissions\Repositories\PermissionRepo;
use arghavan\RolePermissions\Repositories\RoleRepo;

class RolePermissionController extends Controller
{
    public $roleRepo;
    public $permissionRepo;
    public function __construct(RoleRepo $roleRepo,PermissionRepo $permissionRepo)
    {
        $this->roleRepo = $roleRepo;
        $this->permissionRepo = $permissionRepo;
    }
    public function index()
    {
        $this->authorize('manage',Role::class);
        $permissions = $this->permissionRepo->all();
        $roles = $this->roleRepo->paginate();
        return view('RolePermissions::index',compact('permissions','roles'));
    }

    public function store(RoleRequest $request)
    {
        $this->authorize('manage',Role::class);
        $this->roleRepo->create($request);
        toastr()->success('عملیات با موفقیت انجام شد!','موفق');
        return redirect(route('role-permissions.index'));
    }

    public function edit($roleId)
    {
        $this->authorize('manage',Role::class);
        $role = $this->roleRepo->findById($roleId);
        $permissions = $this->permissionRepo->all();
        return view('RolePermissions::edit',compact('role','permissions'));
    }

    public function update(RoleUpdateRequest $request, $roleId)
    {
        $this->authorize('manage',Role::class);
        $this->roleRepo->update($request,$roleId);
        toastr()->success('عملیات با موفقیت انجام شد!','موفق');
        return redirect(route('role-permissions.index'));
    }

    public function destroy($roleId)
    {
        $this->authorize('manage',Role::class);
        $this->roleRepo->delete($roleId);
    }
}
