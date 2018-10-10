<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckphoneRequest extends FormRequest
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
            '_phone'=>['required','regex:/^(13[0-9]|14[579]|15[0-3,5-9]|16[6]|17[0135678]|18[0-9]|19[89])\d{8}$/']
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            '_phone.required'=>'手机号码必须存在!', 
            '_phone.regex'=>'手机号码格式不对的呢!',
        ];
    }
}
