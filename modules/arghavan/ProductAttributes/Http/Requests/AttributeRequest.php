<?php

namespace arghavan\ProductAttributes\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttributeRequest extends FormRequest

{

    public function authorize()
    {
        return auth()->check() == true;
    }


    public function rules()
    {
        $rules = [
            "name" => 'required|min:3|max:190',
            "value" => 'required|min:3|max:190',
        ];

        return $rules;
    }

    public function attributes()
    {
        return [
            "name" => "نام ویژگی",
            "value" => "مقدار ویژگی",
        ];
    }
}
