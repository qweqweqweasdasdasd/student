<?php

namespace App\Http\Controllers\Home;

use Auth;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    //学员登录
    public function login(Request $request)
    {
    	if($request->isMethod('post')){
    		$rules = [
    			'std_name'=>'required',
    			'password'=>'required'
    		];
    		$messages = [
    			'std_name.required'=>'用户名称必须存在',
    			'password.required'=>'密码必须存在',
    		];
    		$validator = Validator::make($request->all(),$rules,$messages);
    		//验证ok
    		if($validator->passes()){
    			//auth验证
    			if(!Auth::guard('home')->attempt($request->all())){
    				return ['code'=>config('code.error'),'error'=>'用户名或者密码错误'];
    			};
    			//异步短信通知会员登录
    			return ['code'=>config('code.success')];
    		}
    		$error = collect($validator->messages())->implode('0', '|');

    		return ['code'=>config('code.error'),'error'=>$error];
    	}
    	return view('home.student.login');
    }

    //学员退出登录
    public function logout()
    {
        //退出登录
        Auth::guard('home')->logout();
        return redirect('/home/student/login');
    }

    //学员注册
    public function register(Request $request)
    {
        
        return view('home.student.register');
    }
}
