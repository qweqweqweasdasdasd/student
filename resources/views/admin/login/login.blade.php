@extends('admin/common/master')
@section('title','login')
@section('content')
@section('my-css')
<link rel="stylesheet" type="text/css" href="/admin/static/admin/css/login.css" />
@endsection
<div class="m-login-bg">
	<div class="m-login">
		<h3>学风教育管理</h3>
		<div class="m-login-warp">
			<form class="layui-form">
				<div class="layui-form-item">
					<input type="text" name="mg_name" placeholder="用户名" autocomplete="off" class="layui-input">
				</div>
				<div class="layui-form-item">
					<input type="text" name="password" placeholder="密码" autocomplete="off" class="layui-input">
				</div>
				<div class="layui-form-item">
					<div class="layui-inline">
						<input type="text" name="code" placeholder="验证码" autocomplete="off" class="layui-input">
					</div>
					<div class="layui-inline">
						<img class="verifyImg" onclick="this.src=this.src+'?c='+Math.random();" src="{{captcha_src()}}" />
					</div>
				</div>
				<div class="layui-form-item m-login-btn">
					<div class="layui-inline">
						<button class="layui-btn layui-btn-normal" lay-submit lay-filter="login">登录</button>
					</div>
					<div class="layui-inline">
						<button type="reset" class="layui-btn layui-btn-primary">取消</button>
					</div>
				</div>
			</form>
		</div>
		<p class="copyright">Copyright 2017-2022 by QQ2895086093</p>
	</div>
</div>
@endsection
@section('my-js')
<script type="text/javascript">
	layui.use(['form','jquery'],function(){
		var $ = layui.jquery,
			form = layui.form();

		//监听提交
		form.on('submit(login)',function(data){
			//ajax
			$.ajax({
				url:'/dologin',
				data:data.field,
				dataType:'json',
				type:'post',
				headers:{
					'X-CSRF-TOKEN':'{{csrf_token()}}'
				},
				success:function(msg){
					if(msg.code == 1){
						window.location.href = '/index/index';
					}else if(msg.code == 0){
						layer.alert(msg.msg);
					}else if(msg.code == 100){
						layer.alert(msg.msg);
					}
				},
				error:function(jqXHR, textStatus, errorThrown){
					var msg = '';
					$.each(jqXHR.responseJSON,function(i,item){
						msg += item;
					})
					if(msg != ''){
						layer.alert(msg);
					}
				}
			});
			return false;
		});
	});
</script>
@endsection