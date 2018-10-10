<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeacherRequest extends FormRequest
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
            'teacher_name'=>'required|between:2,6',
            'teacher_phone'=>['required','regex:/^(13[0-9]|14[579]|15[0-3,5-9]|16[6]|17[0135678]|18[0-9]|19[89])\d{8}$/'],
            'province'=>'required',
            'city'=>'required',
            'area'=>'required',
            'teacher_address'=>'required',
            'teacher_email'=>'required|email',
            'teacher_pic'=>'required',
            'status'=>'required',
            'teacher_desc'=>'max:255',
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
            'teacher_name.required'=>'老师的名称必须添加!',
            'teacher_name.between'=>'老师的名称在2到6个字符之间!',
            'teacher_phone.required'=>'手机号码必须填写!',
            'teacher_phone.regex'=>'手机号码的格式不对!',
            'province.required'=>'省份必须填写',
            'city.required'=>'城市必须填写',
            'area.required'=>'区必须填写',
            'teacher_address.required'=>'详细地址必须填写',
            'teacher_email.required'=>'邮箱必须填写',
            'teacher_email.email'=>'邮箱格式不对',
            'teacher_pic.required'=>'老师的头像必须上传',
            'teacher_pic.image'=>'老师的头像必须为图片',
            'status.required'=>'老师的状态必须存在',
            'teacher_desc.max'=>'老师的备注不得超出255个字符',
        ];
    }
}
