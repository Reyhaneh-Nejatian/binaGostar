<?php

namespace arghavan\Category\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{

    public function authorize()
    {
        return auth()->check() == true;
    }


    public function rules()
    {
        return [
            'title' => 'required|min:2|max:190',
            'slug' => 'required|min:2|max:190',
            'parent_id' => 'nullable|exists:categories,id',
        ];
    }

    public function attributes()
    {
        return [
            "title" => "نام دسته بندی",
            "slug" => "نام انگلیسی دسته بندی",
        ];
    }
}
