<?php


namespace arghavan\RolePermissions\Repositories;


use Spatie\Permission\Models\Role;

class RoleRepo
{
    public function all()
    {
        return Role::all();
    }
    public function paginate()
    {
        return Role::paginate(10);
    }


    public function create($request)
    {
        return Role::query()->create(['name' => $request->name])->syncPermissions($request->permissions);
    }

    public function findById($roleId)
    {
        return Role::findOrFail($roleId);
    }

    public function update($request, $roleId)
    {
        $role = $this->findById($roleId);
        return $role->syncPermissions($request->permissions)->update(['name' => $request->name]);
    }

    public function delete($roleId)
    {
        return Role::query()->whereId($roleId)->delete();
    }
}
