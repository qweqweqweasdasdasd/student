@extends('home/common/master')
@section('my-css')
<link rel="stylesheet" href="/home/css/page-learing-student-register.css" />
@endsection
@section('content')
<!-- 页面 -->
<div class="register">
<div class="register-head">
    <div class="wrap">
        <a href="javascript:;" class="logo">
        <img src="/home/img/asset-logoico.png" alt="logo" width="200">
    </a>
        <div class="gologin">我有账号 去<a href="/home/student/login">登录</a></div>
    </div>
</div>
<div class="register-body">
    <img src="/home/img/page-register_img.jpg" alt="" class="register-ico" width="460">
    <form class="form-horizontal required-validate" id="regStudentForm">
        <ul class="r-position student">
            <li>
                <div class="page-header">
                    <h3>欢迎注册在线教育</h3>
                </div>
            </li>
            <li>
                <div class="form-group">
                    <label class="col-sm-3 control-label">手机号码</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="phone" placeholder="请输入手机号码">
                        <span class="verif-span"></span>
                    </div>
                </div>
            </li>
            <li>
                <div class="form-group">
                    <label class="col-sm-3 control-label">验证码</label>
                    <div class="col-sm-9 verif">
                        <input type="text" class="form-control" name="verif" placeholder="请输入验证码">
                        <button class="btn btn-default send" type="button">发送验证码</button>
                        <span class="verif-span"></span>
                    </div>
                </div>
            </li>
            <!-- <li>
                <div class="form-group">
                    <label class="col-sm-3 control-label">密码</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" name="password" placeholder="请输入密码">
                        <span class="verif-span"></span>
                    </div>
                </div>
            </li>
            <li>
                <div class="form-group">
                    <label class="col-sm-3 control-label">确认密码</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" name="confirm" placeholder="确认密码">
                        <span class="verif-span"></span>
                    </div>
            </li> -->
            <li class="mag-left">
                <div class="checkbox">
                    <label>
                <input type="checkbox">同意协议并注册
                <a href="javascript:;">《学成网注册协议》</a>
            </label>
                </div>
            </li>
            <li class="mag-left">
                <button name="register" type="button" class="btn btn-primary">完成注册</button>
            </li>
        </ul>
    </form>
    </div>
    <div class="register-footer">
      	@include('home.common.footer')
    </div>
</div>
@endsection
@section('my-js')
<script src="/home/js/page-learing-student-register.js"></script>
<script type="text/javascript">
	//请求短信接口服务
	function sendSMS(){
		var _phone = $('input[name="phone"]').val();
		//ajax
		$.ajax({
			url:'/server/sendsms',
			data:{_phone:_phone},
			dataType:'json',
			type:'post',
			headers:{
				'X-CSRF-TOKEN':'{{csrf_token()}}'
			},
			success:function(msg){
                var code = msg.code[0];
                var msg = msg.msg[0];
                if(msg.code != 1){
                    layer.alert('错误编号:'+code+'错误信息:'+msg);
                }else{
                    layer.alert(msg.error);
                }
                
			},
			error:function(jqXHR, textStatus, errorThrown){
				var msg = '';
				$.each(jqXHR.responseJSON,function(i,item){
					msg += item;
				});
				if(msg != ''){
					layer.alert(msg);
				}
			}
		})
		return false;
	}
</script>
@endsection

