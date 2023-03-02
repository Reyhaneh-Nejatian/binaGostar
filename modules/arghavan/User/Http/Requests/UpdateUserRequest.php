<?php

namespace arghavan\User\Http\Requests;


use arghavan\User\Rules\validMobile;
use arghavan\User\Rules\validPassword;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use arghavan\User\Models\User;

class UpdateUserRequest extends FormRequest
{

    public function authorize()
    {
        return auth()->user() == true;
    }


    public function rules()
    {
        $rules = [
            'name' => 'required|min:3|max:190',
            'email' => 'required|email|min:3|max:190|unique:users,email,' . request()->route('user'),
            "username" => 'nullable|min:3|max:190|unique:users,username,' . request()->route('user'),
            "mobile" => ['nullable', 'string', 'min:9', 'max:14', 'unique:users',new validMobile()],
            "status" => ["required", Rule::in(User::$statuses)],
            "image" => "nullable|mimes:jpg,png,jpeg",
            'password' => ['required', 'string', 'min:6', 'confirmed',new validPassword()],
        ];

        if (request()->method === 'PATCH') {
            $rules['image'] = "nullable|mimes:jpg,png,jpeg";
            $rules['password'] = 'nullable';
            $rules['mobile'] = 'nullable|unique:users,mobile,' . request()->route('user');
            $rules['password'] = ['nullable', 'string', 'min:6', 'confirmed',new validPassword()];

        }

        return $rules;
    }

    public function attributes()
    {
        return [
            "name" => "نام",
            "email" => "ایمیل",
            "username" => "نام کاربری",
            "mobile" => "موبایل",
            "status" => "وضعیت",
            "image" => "عکس پروفایل",
        ];
    }
}
