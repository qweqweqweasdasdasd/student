@extends('admin/common/master')
@section('title','角色编辑')
@section('my-css')
<link rel="stylesheet" type="text/css" href="/admin/static/admin/css/admin.css" />
@endsection
@section('content')
<div class="wrap-container">
<form class="layui-form" style="width: 90%;padding-top: 20px;">
		<input type="hidden" name="r_id" value="{{$role->r_id}}">
		<div class="layui-form-item">
			<label class="layui-form-label">角色：</label>
			<div class="layui-input-block">
				<input type="text" name="r_name" placeholder="请输入角色" autocomplete="off" class="layui-input" value="{{$role->r_name}}">
			</div>

		</div>
		<div class="layui-form-item">
			<div class="layui-input-block">
				<button class="layui-btn layui-btn-normal" lay-submit lay-filter="formDemo">立即提交</button>
				<button type="reset" class="layui-btn layui-btn-primary">重置</button>
			</div>
		</div>
	</form>
</div>
@endsection
@section('my-js')
<script type="text/javascript">
	layui.use(['form','jquery'],function(){
		var $ = layui.jquery,
			form = layui.form();

		//提交监听
		form.on('submit(formDemo)',function(data){
			var r_id = $('input[type="hidden"]').val();
			//ajax
			$.ajax({
				url:'/role'+'/'+r_id,
				data:data.field,
				type:'PATCH',
				dataType:'json',
				headers:{
					'X-CSRF-TOKEN':'{{csrf_token()}}'
				},
				success:function(msg){
					if(msg.code == 1){
						parent.window.location.href = '/role';
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
		})
	});
</script>
@endsection