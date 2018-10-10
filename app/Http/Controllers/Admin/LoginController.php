<?php

namespace App\Http\Controllers\Admin;

use DB;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreManagerRequest;

class LoginController extends Controller
{
    //后台管理--登录显示
    public function login()
    {
    	return view('admin.login.login');
    }

    //后台管理--管理登出
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/login');
    }

    //后台管理--登录操作
    public function dologin(StoreManagerRequest $request)
    {
    	$namg_pass = $request->only(['mg_name','password']);
    	if(!Auth::guard('admin')->attempt($namg_pass)){
    		return ['code'=>config('code.error'),'msg'=>'用户名或者密码错误,请重新填写!'];
    	}
    	//单用户登录限制 后面放到公用类库内
    	$this->singleUser($request);
    	//管理员状态情况
    	if(!DB::table('manager')->where('mg_id',getAuthManager()->mg_id)->first()->status){
    		return ['code'=>config('code.freeze'),'msg'=>'管理员状态停用了'];
    	}
    	
    	return ['code'=>config('code.success')];
    }

    //后台管理--单用户登录限制
    public function singleUser($request)
    {
    	$post_session_id = $request->session()->getId();
    	$session_id = DB::table('manager')->where('mg_id',getAuthManager()->mg_id)->value('session_id');
    	if(empty($session_id)){	
    		DB::table('manager')->where('mg_id',getAuthManager()->mg_id)->update(['session_id'=>$post_session_id]);
    	};
    	if($session_id != $post_session_id){
    		//删除之前的session
    		@unlink(storage_path().'/framework/sessions/'.$session_id);
    		DB::table('manager')->where('mg_id',getAuthManager()->mg_id)->update(['session_id'=>$post_session_id]);
    	}
    }
}
