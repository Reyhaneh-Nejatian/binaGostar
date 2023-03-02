<?php

namespace arghavan\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserPhotoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() == true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'userPhoto' => ['required','mimes:jpg,png,jpeg']
        ];
    }

    public function attributes()
    {
        return [
            "userPhoto" => "عکس کاربری",

        ];
    }
}
