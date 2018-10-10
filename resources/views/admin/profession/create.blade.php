@extends('admin/common/master')
@section('title','专业管理')
@section('my-css')
<link rel="stylesheet" type="text/css" href="/admin/static/admin/css/admin.css" />
@endsection
@section('content')
<div class="wrap-container">
	<form class="layui-form" style="width: 90%;padding-top: 20px;">
		<div class="layui-form-item">
			<label class="layui-form-label">专业名称：</label>
			<div class="layui-input-block">
				<input type="text" name="pro_name"  placeholder="请输入专业名称" autocomplete="off" class="layui-input">
			</div>

		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">状态：</label>
			<div class="layui-input-block">
				<input type="radio" name="status" value="1" title="显示" checked>
				<input type="radio" name="status" value="0" title="隐藏">
			</div>

		</div>
		<div class="layui-form-item layui-form-text">
			<label class="layui-form-label">专业备注：</label>
			<div class="layui-input-block">
				<textarea name="pro_desc" placeholder="请输入专业备注" class="layui-textarea"></textarea>
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

			//ajax
			$.ajax({
				url:'/profession',
				data:data.field,
				dataType:'json',
				type:'post',
				headers:{
					'X-CSRF-TOKEN':'{{csrf_token()}}'
				},
				success:function(msg){
					if(msg.code == 1){
						parent.window.location.href = '/profession';
					}
				}
			})
			return false;
		});
	});
</script>
@endsection