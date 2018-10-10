@extends('admin/common/master')
@section('title','课时管理')
@section('my-css')
<link rel="stylesheet" type="text/css" href="/admin/static/admin/css/admin.css" />
@endsection
@section('content')
<div class="wrap-container">
	<form class="layui-form" style="width: 90%;padding-top: 20px;">
		<input type="hidden" name="lesson_id" value="{{$lesson->lesson_id}}">
		<div class="layui-form-item">
			<label class="layui-form-label">课时名称：</label>
			<div class="layui-input-block">
				<input type="text" name="lesson_name"  placeholder="请输入课时名称" autocomplete="off" class="layui-input" value="{{$lesson->lesson_name}}">
			</div>

		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">专业-课程：</label>
			<div class="layui-input-inline">
	            <select name="" lay-search="" lay-filter="pro">
	                <option value="">请选择专业</option>
	                @foreach($professions as $v)
	                <option value="{{$v->pro_id}}" @if($lesson->course->pro_id == $v->pro_id) selected @endif>{{$v->pro_name}}</option>
	                @endforeach
	            </select>
	        </div>
	        <div class="layui-input-inline">
	            <select name="course_id" lay-search="" lay-filter="course">
	                <option value="">请选择课程</option>
	               	<!-- 二级的选项区 -->
	               	@foreach($courses as $v)
	               	<option value="{{$v->course_id}}" @if($lesson->course_id == $v->course_id) selected @endif>{{$v->course_name}}</option>
	               	@endforeach
	            </select>
	        </div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">老师们：</label>
			<div class="layui-input-block">
				<select name="teacher_ids" >
					@foreach($teacher_arr as $k => $v)
					<option value="{{$k}}" @if($lesson->teacher_ids == $k) selected @endif>{{$v}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">时长：</label>
			<div class="layui-input-inline">
				<input type="number" name="lesson_duration" placeholder="请输入时长" autocomplete="off" class="layui-input" value="{{$lesson->lesson_duration}}">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">图像上传：</label>
			<div class="layui-input-block" >
				<input type="file" name="file" class="layui-upload-file">
			</div>
			<div id="image">
				<img src="{{$lesson->cover_img}}" width="100px;" style="position:relative;left:100px;top: 10px;">
				<input type="hidden" name="cover_img" value="{{$lesson->cover_img}}">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">状态：</label>
			<div class="layui-input-block">
				<input type="radio" name="status" value="1" title="正常" @if($lesson->status == 1) checked @endif>
				<input type="radio" name="status" value="2" title="停播" @if($lesson->status == 2) checked @endif>
			</div>
		</div>
		<div class="layui-form-item layui-form-text">
			<label class="layui-form-label">课时备注：</label>
			<div class="layui-input-block">
				<textarea name="lesson_desc" placeholder="请输入课时备注" class="layui-textarea">{{$lesson->lesson_desc}}</textarea>
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
		var $ = layui.jquery,
			upload = layui.upload,
			form = layui.form();

		//二级联动监听
		form.on('select(pro)',function(data){
			var pro_id = data.value;
			//ajax
			$.ajax({
				url:'/lesson/getcoursebypro',
				data:{pro_id:pro_id},
				dataType:'json',
				type:'post',
				headers:{
					'X-CSRF-TOKEN':'{{csrf_token()}}'
				},
				success:function(msg){
					if(msg.code == 1){
						$('select[name="course_id"]').html('');
						var option = '<option value="">请选择课程</option>';
						$.each(msg.course,function(i,item){
							option += '<option value="'+item.course_id+'">'+item.course_name+'</option>';
						});
						$('select[name="course_id"]').append(option);
						form.render();
					}else{
						layer.msg('没有数据的呢');
					}
				}
			});
			console.log(data);
		});

		//提交监听
		form.on('submit(formDemo)',function(data){
			var lesson_id = $('input[type="hidden"]').val();
			//ajax
			$.ajax({
				url:'/lesson'+'/'+lesson_id,
				data:data.field,
				dataType:'json',
				type:'PATCH',
				headers:{
					'X-CSRF-TOKEN':'{{csrf_token()}}'
				},
				success:function(msg){
					if(msg.code == 1){
						parent.window.location.href = '/lesson';
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
				$('#image').html('');
					var img = '<img src="'+res.path_url+'" width="100px;" style="position:relative;left:100px;top: 10px;">';
					var input = '<input type="hidden" name="cover_img" value="'+res.path_url+'">';
					$('#image').append(img);
					$('#image').append(input);
				}
				console.log(res); //上传成功返回值，必须为json格式
			}
		});
	});
</script>
@endsection