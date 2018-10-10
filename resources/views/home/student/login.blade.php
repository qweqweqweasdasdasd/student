@extends('home/common/master')
@section('title','登录')
@section('my-css')
<link rel="stylesheet" href="/home/css/page-learing-sign.css" />
@endsection
@section('content')
<!-- 页面 -->
<div class="register">
    <div class="register-head">
        <div class="wrap">
            <a href="javascript:;" class="logo">
            <img src="/home/img/asset-logoico.png" alt="logo" width="200">
        </a>
            <div class="go-regist" style="position: absolute;border-bottom: 10px;">还没有账号？<a href="{{url('/home/student/register')}}">去注册</a></div>
        </div>
    </div>
    <div class="register-body">
        <div class="register-cent">
            <img src="/home/img/asset-login_img.jpg" alt="" class="register-ico">
            <form class="required-validate" id="regStudentForm">
                <ul class="r-position login">
                    <li>
                        <div class="page-header">
                            <h3>欢迎登录在线教育</h3>
                        </div>
                    </li>
                    <li>
                        <div class="form-group">
                            <label class="control-label">登录名：</label>
                            <div class="">
                                <input type="text" class="form-control" name="std_name" placeholder="请输入登录名">
                                <span class="verif-span">请输入5-25个字符</span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="form-group">
                            <label class="control-label">密码</label>
                            <div class="">
                                <input type="password" class="form-control" name="password" placeholder="请输入密码">
                                <span class="verif-span">请输入6-16个字符</span>
                            </div>
                        </div>
                    </li>
                    <li class="">
                        <button name="login" type="submit" class="btn btn-primary">登录</button>
                    </li>
                </ul>
            </form>
        </div>
    </div>
    <div class="register-footer">
    	@include('home.common.footer')
    </div>
</div>
@endsection
@section('my-js')
<script type="text/javascript">
	$('#regStudentForm').submit(function(evt){
		evt.preventDefault();
		var shuju = $(this).serialize();
		//ajax
		$.ajax({
			url:'/home/student/login',
			data:shuju,
			dataType:'json',
			type:'post',
			headers:{
				'X-CSRF-TOKEN':'{{csrf_token()}}'
			},
			success:function(msg){
				if(msg.code == 0){
					layer.alert(msg.error);
				}else if(msg.code == 1){
					window.location.href = '/';
				}
			}
		})
	});
</script>
@endsection
