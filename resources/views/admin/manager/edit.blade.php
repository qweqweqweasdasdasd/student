@extends('admin/common/master')
@section('title','管理员编辑')
@section('my-css')
<link rel="stylesheet" type="text/css" href="/admin/static/admin/css/admin.css" />
@endsection
@section('content')
<div class="wrap-container">
<form class="layui-form" style="width: 90%;padding-top: 20px;">
		<input type="hidden" name="mg_id" value="{{$manager->mg_id}}">
		<div class="layui-form-item">
			<label class="layui-form-label">管理员：</label>
			<div class="layui-input-block">
				<input type="text" name="mg_name" placeholder="请输入管理员" autocomplete="off" class="layui-input" value="{{$manager->mg_name}}">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">密码：</label>
			<div class="layui-input-inline">
				<input type="text" name="password" placeholder="请输入密码" autocomplete="off" class="layui-input" value="{{$manager->password}}">
			</div>
			<button class="layui-btn create-password">生成随机的密码</button>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">角色：</label>
			<div class="layui-input-block">
				<select name="r_id" >
					<option value="">请给管理员一个角色</option>
					@foreach($roles as $v)
					<option value="{{$v->r_id}}" @if($v->r_id == $manager->r_id) selected @endif>{{$v->r_name}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">状态：</label>
			<div class="layui-input-block">
				<input type="radio" name="status" value="1" title="正常" @if($manager->status == 1) checked @endif/>
				<input type="radio" name="status" value="0" title="停用" @if($manager->status == 0) checked @endif/>
			</div>
		</div>
		<div class="layui-form-item layui-form-text">
			<label class="layui-form-label">备注：</label>
			<div class="layui-input-block">
				<textarea name="remark" placeholder="请输入内容" class="layui-textarea">{{$manager->remark}}</textarea>
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
		var mg_id = $('input[type="hidden"]').val();

		//生成随机的密码
		$('.create-password').on('click',function(){
			$('input[name="password"]').val(random_str());
			return false;
		});

		//随机字符串
		function random_str() {
			var str = '';
			arr = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
				      'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l',
				      'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
				      'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L',
				      'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
				      '-','.','~','!','@','#','$','%','^','&','*','(',')','_',':','<','>','?'];
			for (var i = 0; i < 20; i++) {
				pos = Math.round(Math.random()*(arr.length - 1));
				str += arr[pos];
			}
			return str;
		}

		//提交监听
		form.on('submit(formDemo)',function(data){
			//ajax
			$.ajax({
				url:'/manager'+'/'+mg_id,
				data:data.field,
				type:'PATCH',
				dataType:'json',
				headers:{
					'X-CSRF-TOKEN':'{{csrf_token()}}'
				},
				success:function(msg){
					if(msg.code == 1){
						parent.window.location.href = '/manager';
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