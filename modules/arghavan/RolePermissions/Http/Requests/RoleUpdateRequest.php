<?php


namespace arghavan\RolePermissions\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class RoleUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "id" => 'required|exists:roles,id',
            "name" => 'required|min:3|unique:roles,name,'.request()->id,
            "permissions" => 'required|array|min:1'
        ];
    }
}
