<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreManagerRequest extends FormRequest
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
            'mg_name'=>'required|max:6',
            'password'=>'required|between:4,22',
            'code'=>'required|captcha',
        ];
    }

    /**
     * 自定义错误信息
     *
     * @return array
     */
    public function messages()
    {
        return [
            'mg_name.required'=>'管理员名称必须填写!',
            'mg_name.max'=>'管理员不得大于6个字符!',
            'password.required'=>'密码必须填写!',
            'password.between'=>'密码为4-22个字符!',
            'code.required'=>'验证码必须填写!',
            'code.captcha'=>'验证码不对!',
        ];
    }
}
