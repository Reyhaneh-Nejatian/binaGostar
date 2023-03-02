<?php

namespace arghavan\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use arghavan\User\Rules\validPassword;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => ['required',new validPassword(),'confirmed']
        ];
    }

    public function attributes()
    {
        return [
            "password" => "رمز عبور",

        ];
    }
}
