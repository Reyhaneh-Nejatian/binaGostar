<?php

namespace arghavan\Brands\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
        $rules = [
            "image" => "required|file|image",
            "name" => "required|min:2",
            "status" => "required|boolean",
        ];

        if (request()->method === 'PATCH') {
            $rules['image'] = "nullable|file|image";
        }
        return $rules;
    }
}
