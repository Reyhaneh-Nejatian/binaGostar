<?php

namespace arghavan\Product\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{

    public function authorize()
    {
        return auth()->check() == true;
    }


    public function rules()
    {
        $rules = [
            "name" => 'required|min:3|max:190',
            "priority" => 'nullable|numeric',
            "price" => 'required|numeric|min:0|max:1000000000',
            "priceOff" => 'nullable|numeric|min:0|max:1000000000',
            "weight" => 'required|numeric',
            "numbers" => 'required|numeric',
            "category_id" => 'nullable|exists:categories,id',
            "brand_id" => 'nullable|exists:brands,id',
            "model_id" => 'nullable|exists:models,id',
            "image" => 'required',
            "image.*" => 'mimes:jpg,png.jpeg',
            "description" => 'required|min:3|max:190',
        ];

        if(request()->method === 'PATCH'){
            $rules['image'] = 'nullable|mimes:jpg,png.jpeg';
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            "price" => "قیمت",
            "weight" => "وزن محصول",
            "priority" => "ردیف محصول",
            "category_id" => "دسته بندی",
            "brand_id" => "برند",
            "model_id" => "مدل",
            "numbers" => "تعداد محصول",
            "body" => " توضیحات کامل",
            "description" => " خلاصه معرفی محصول",
            "image" => "تصویر محصول",
        ];
    }
}
