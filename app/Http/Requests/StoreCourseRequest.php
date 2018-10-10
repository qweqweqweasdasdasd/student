<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
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
            'course_name'=>'required',
            'pro_id'=>'required|integer',
            'course_price'=>'required|numeric',
            'course_desc'=>'max:250',
        ];
    }
     /**
     * 自定义短信
     *
     * @return array
     */
    public function messages()
    {
        return [
            'course_name.required'=>'课程的名称必须填写! ',
            'pro_id.required'=>'专业必须填写! ',
            'pro_id.integer'=>'专业格式需要是数值! ',
            'course_price.required'=>'课程价格必须填写! ',
            'course_price.numeric'=>'课程价格必须为数字! ',
            'course_des.max'=>'课程备注不得超出255个字符! ',
        ];
    }
}
