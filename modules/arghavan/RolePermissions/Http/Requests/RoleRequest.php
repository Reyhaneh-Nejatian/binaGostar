<?php


namespace arghavan\RolePermissions\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|min:3|unique:roles,name',
            'permissions' => 'required|array|min:1'
        ];
    }
}
