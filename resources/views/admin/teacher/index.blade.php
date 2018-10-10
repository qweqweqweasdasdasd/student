@extends('admin/common/master')
@section('title','老师列表')
@section('my-css')
<link rel="stylesheet" type="text/css" href="/admin/static/admin/css/admin.css" />
@endsection
@section('content')
<div class="wrap-container clearfix">
	<div class="column-content-detail">
		<form class="layui-form" action="">
			<div class="layui-form-item">
				<div class="layui-inline tool-btn">
					<button class="layui-btn layui-btn-small layui-btn-normal addBtn" ><i class="layui-icon">&#xe654;</i>新增老师</button>
					<button class="layui-btn layui-btn-small layui-btn-warm shuaxin" ><i class="iconfont">&#xe656;</i>刷新</button>
				</div>
				<div class="layui-inline">
					<input type="text" name="teacher_name" placeholder="请输入老师姓名" autocomplete="off" class="layui-input" value="{{$_GET['teacher_name']}}">
				</div>
				<div class="layui-inline">
					<select name="status" lay-filter="status">
						<option value="0" @if($_GET['status'] == 0) selected @endif>全部状态</option>
						<option value="1" @if($_GET['status'] == 1) selected @endif>正常</option>
						<option value="2" @if($_GET['status'] == 2) selected @endif>离职</option>
					</select>
				</div>
				<button class="layui-btn layui-btn-normal" lay-submit="search" id="search">搜索</button>
			</div>
		</form>
		<div class="layui-form" id="table-list">
			<table class="layui-table" lay-even lay-skin="line">
				<colgroup>
					<col width="50">
					<col class="hidden-xs" width="130">
					<col>
					<col class="hidden-xs" width="150">
					<col class="hidden-xs" width="150">
					<col width="80">
					<col width="250">
				</colgroup>
				<thead>
					<tr>
						<!-- <th><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose"></th> -->
						<th>ID</th>
						<th class="hidden-xs">老师头像</th>
						<th class="hidden-xs">老师名称</th>
						<th>手机号码</th>
						<th class="hidden-xs">创建时间</th>
						<th>状态</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody>
					@foreach($teacher as $v)
					<tr>
						<!-- <td><input type="checkbox" name="" lay-skin="primary" data-id="{{$v->teacher_id}}"></td> -->
						<td>{{$v->teacher_id}}</td>
						<td><img src="{{$v->teacher_pic}}" width="70px;"></td>
						<td>
							<a href="#" class="layui-btn layui-btn-primary teacher-info" data-id="{{$v->teacher_id}}">{{$v->teacher_name}}</a>
						</td>
						<td>{{$v->teacher_phone}}</td>
						<td class="hidden-xs">{{$v->created_at}}</td>
						<td><button class="layui-btn layui-btn-mini  @if($v->status == 1) layui-btn-warm @else layui-btn-primary @endif ">
							@if($v->status == 1)
							正常
							@else($v->satatus == 2)
							离职
							@endif
						</button></td>
						<td>
							<div class="layui-inline">
								<button class="layui-btn layui-btn-mini dis-btn" data-id="{{$v->teacher_id}}" ><i class="layui-icon">&#xe614;</i>分配课程</button>
								<button class="layui-btn layui-btn-mini layui-btn-normal edit-btn" data-id="{{$v->teacher_id}}" ><i class="layui-icon">&#xe642;</i>编辑</button>
								<button class="layui-btn layui-btn-mini layui-btn-danger del-btn" data-id="{{$v->teacher_id}}" ><i class="layui-icon">&#xe640;</i>删除</button>
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			<div class="page-wrap">
				<!--  -->
				{{ $teacher->appends(['teacher_name'=>$data['teacher_name'],'status'=>$data['status']])->links() }}
			</div>
		</div>
	</div>
</div>
@endsection
@section('my-js')
<script type="text/javascript">
	layui.use(['form','jquery'],function(){
		var $ = layui.jquery,
			form = layui.form();

		//分配老师所精通课程
		$('.dis-btn').on('click',function(){
			var teacher_id = $(this).attr('data-id');
			var index = layer.open({
			      type: 2,
			      title: '分配课程',
			      shadeClose: true,
			      shade: [0.5],
			      maxmin: true, //开启最大化最小化按钮
			      area: ['893px', '450px'],
			      content: '/teacher/dis/'+teacher_id
			    });
			layer.full(index);
			return false;
		});

		//查看指定的老师信息
		$('.teacher-info').on('click',function(){
			var teacher_id = $(this).attr('data-id');

			var index = layer.open({
			      type: 2,
			      title: '老师详情',
			      shadeClose: true,
			      shade: [0.5],
			      maxmin: true, //开启最大化最小化按钮
			      area: ['893px', '450px'],
			      content: '/teacher/info/'+teacher_id
			    });

			return false;
		});
		//删除指定的老师
		$('.del-btn').on('click',function(data){
			var teacher_id = $(this).attr('data-id');
			var _this = $(this);
			//ajax
			$.ajax({
				url:'/teacher'+'/'+teacher_id,
				data:{teacher_id:teacher_id},
				dataType:'json',
				type:'DELETE',
				headers:{
					'X-CSRF-TOKEN':'{{csrf_token()}}'
				},
				success:function(msg){
					if(msg.code == 1){
						_this.parent().parent().parent().remove();
					}
				}
			});
			return false;
		});

		//编辑老师
		$('.edit-btn').on('click',function(data){
			var teacher_id = $(this).attr('data-id');
			var index =	layer.open({
			      type: 2,
			      title: '编辑老师信息',
			      shadeClose: true,
			      shade: false,
			      maxmin: true, //开启最大化最小化按钮
			      area: ['893px', '600px'],
			      content: 'teacher/'+teacher_id+'/edit'
			    });
			layer.full(index);
			return false;
		});

		//新增教师
		$('.addBtn').on('click',function(){
			var index = layer.open({
			      type: 2,
			      title: '新增教师',
			      shadeClose: true,
			      shade: false,
			      maxmin: true, //开启最大化最小化按钮
			      area: ['893px', '600px'],
			      content: 'teacher/create'
			    });
			layer.full(index);
			return false;
		});

		//刷新当前的页面
		$('.shuaxin').on('click',function(data){
			window.location.href = '/teacher';
			return false;
		});

		//禁止键盘监听
		$('input').on('keydown',function(data){
			if(data.keyCode == 13){
				$('#search').click();
				return false;
			}
			console.log(data);
		});
	});
</script>
@endsection