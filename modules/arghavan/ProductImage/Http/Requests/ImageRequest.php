<?php

namespace arghavan\ProductImage\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest
{

    public function authorize()
    {
        return auth()->check() == true;
    }


    public function rules()
    {
        $rules = [
            "image" => "required|file|image",
            "status" => "required|boolean",
        ];

        if (request()->method === 'PATCH') {
            $rules['image'] = "nullable|file|image";
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            "image" => "تصویر محصول",
            "status" => "وضعیت محصول",
        ];
    }
}
