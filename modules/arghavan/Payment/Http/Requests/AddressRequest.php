<?php

namespace arghavan\Payment\Http\Requests;

use arghavan\User\Rules\validMobile;
use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('api')->check() == true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            "name" => 'required|min:3|max:190',
            "province" => 'required',
            "city" => 'required',
            "mobile" => ['required', 'string', 'min:9', 'max:14',new validMobile()],
            "zipCode" => 'required|numeric|min:10|unique:addresses,zipCode,'. request()->route('addresses'),
            "address" => 'required',
        ];

        if (request()->method === 'PATCH') {
            $rules['zipCode'] = "required|numeric|min:10";
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            "name" => "نام",
            "mobile" => "شماره تماس",
            "zipCode" => "کد پستی",
            "province" => "استان",
            "city" => "شهر",
            "address" => "آدرس",
        ];
    }
}
