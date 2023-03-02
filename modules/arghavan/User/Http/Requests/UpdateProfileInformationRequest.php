<?php


namespace arghavan\User\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use arghavan\User\Rules\validPassword;

class UpdateProfileInformationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "email" => 'required|email|min:3|max:190|unique:users,email,'.auth()->id(),
            "username" => 'nullable|min:3|max:190|unique:users,username,'.auth()->id(),
            "mobile" => 'nullable|unique:users,mobile,'.auth()->id(),
            "password" => ['nullable', 'string', 'min:6', 'confirmed',new validPassword()]
        ];
    }

    public function attributes()
    {
        return [
            'username' => 'نام کاربری',
            'mobile' => 'موبایل',
            'password' => 'رمز عبور',
        ];
    }
}
