@extends('admin/common/master')
@section('title','权限编辑')
@section('my-css')
<link rel="stylesheet" type="text/css" href="/admin/static/admin/css/admin.css" />
@endsection
@section('content')
<div class="wrap-container">
<form class="layui-form" style="width: 90%;padding-top: 20px;">
		<input type="hidden" name="ps_id" value="{{$permission->ps_id}}">
		<div class="layui-form-item">
			<label class="layui-form-label">上级：</label>
			<div class="layui-input-block">
				<select name="ps_pid" >
					<option value="">选择权限的级别</option>
					<option value="">/</option>
					@foreach($permissions as $v)
						<option value="{{$v['ps_id']}}" @if($permission['ps_pid'] == $v['ps_id'])selected @endif>{{str_repeat('├─',$v['level']).$v['ps_name']}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">权限名称：</label>
			<div class="layui-input-block">
				<input type="text" name="ps_name" placeholder="请输入权限" autocomplete="off" class="layui-input" value="{{$permission->ps_name}}">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">icon：</label>
			<div class="layui-input-block">
				<input type="text" name="icon" placeholder="请输入icon" autocomplete="off" class="layui-input" value="{{$permission->icon}}">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">控制器：</label>
			<div class="layui-input-block">
				<input type="text" name="ps_c" placeholder="请输入控制器" autocomplete="off" class="layui-input" value="{{$permission->ps_c}}">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">方法：</label>
			<div class="layui-input-block">
				<input type="text" name="ps_a" placeholder="请输入方法" autocomplete="off" class="layui-input" value="{{$permission->ps_a}}">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">路由：</label>
			<div class="layui-input-block">
				<input type="text" name="ps_route" placeholder="请输入路由" autocomplete="off" class="layui-input" value="{{$permission->ps_route}}">
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
		var ps_id = $('input[type="hidden"]').val();

		//提交监听
		form.on('submit(formDemo)',function(data){
			//ajax
			$.ajax({
				url:'/permission'+'/'+ps_id,
				data:data.field,
				type:'PATCH',
				dataType:'json',
				headers:{
					'X-CSRF-TOKEN':'{{csrf_token()}}'
				},
				success:function(msg){
					if(msg.code == 1){
						parent.window.location.href = '/permission';
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