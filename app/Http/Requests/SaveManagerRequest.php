<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveManagerRequest extends FormRequest
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
            'password'=>'required|between:4,65',
            'status'=>'required|in:0,1',
            'remark'=>'max:250',
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
            'mg_name.required'=>'管理员名称必须填写! ',
            'mg_name.max'=>'管理员名称不得大于6个字符!',
            'password.required'=>'密码必须填写!',
            'password.between'=>'密码必须在4到65个字符之间! ',
            'status.required'=>'状态必须选择! ',
            'status.in'=>'状态的格式不对! ',
            'remark.max'=>'备注不得超出250个字符! ',
        ];
    }
}
