@extends('admin/common/master')
@section('title','课程管理')
@section('my-css')
<link rel="stylesheet" type="text/css" href="/admin/static/admin/css/admin.css" />
@endsection
@section('content')
<div class="wrap-container">
	<form class="layui-form" style="width: 90%;padding-top: 20px;">
		<div class="layui-form-item">
			<label class="layui-form-label">课程名称：</label>
			<div class="layui-input-block">
				<input type="text" name="course_name"  placeholder="请输入课程名称" autocomplete="off" class="layui-input">
			</div>
		</div>
		<div class="layui-form-item">
	        <label class="layui-form-label">所属专业：</label>
	        <div class="layui-input-block">
	            <select name="pro_id" lay-filter="aihao">
	                <option value="">请选择专业</option>
	                @foreach($professions as $v)
	                <option value="{{$v->pro_id}}">{{$v->pro_name}}</option>
	                @endforeach
	            </select>
	        </div>
	    </div>
		<div class="layui-form-item">
			<label class="layui-form-label">课程价格：</label>
			<div class="layui-input-inline">
				<input type="number" name="course_price"  placeholder="请输入价格" autocomplete="off" class="layui-input">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">封面图：</label>
			<div class="layui-input-block">
				<input type="file" name="file" class="layui-upload-file">
			</div>
			<div id="image">
				
			</div>
		</div>
		<div class="layui-form-item layui-form-text">
			<label class="layui-form-label">课程描述：</label>
			<div class="layui-input-block">
				<textarea name="course_desc" placeholder="请输入内容" class="layui-textarea"></textarea>
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
	layui.use(['form','jquery','upload'],function(){
		var upload = layui.upload,
			$ = layui.jquery,
			form = layui.form();

		//提交表单
		form.on('submit(formDemo)',function(data){

			//ajax
			$.ajax({
				url:'/course',
				data:data.field,
				dataType:'json',
				type:'post',
				headers:{
					'X-CSRF-TOKEN':'{{csrf_token()}}'
				},
				success:function(msg){
					if(msg.code == 1){
						parent.window.location.href = '/course';
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
			})
			return false;
		});
		//上传文件
		layui.upload({
			url: '/upload/images',
			method: 'post',
			accept: 'images',
			success: function(res) {
				if(res.code == 1){
					var img = '<img src="'+res.path_url+'" width="100px;" style="position:relative;left:100px;top: 10px;">';
					var input = '<input type="hidden" name="cover_img" value="'+res.path_url+'">';
					$('#image').append(img);
					$('#image').append(input);
				}
				console.log(res); //上传成功返回值，必须为json格式
			}
		});

	})
</script>
@endsection