@extends('admin/common/master')
@section('title','课程')
@section('my-css')
<link rel="stylesheet" type="text/css" href="/admin/static/admin/css/admin.css" />
@endsection
@section('content')
<div class="wrap-container clearfix">
		<div class="column-content-detail">
			<form class="layui-form" action="">
				<div class="layui-form-item">
					<div class="layui-inline tool-btn">
						<button class="layui-btn layui-btn-small layui-btn-normal addBtn" ><i class="layui-icon">&#xe654;</i>新增课程</button>
						<button class="layui-btn layui-btn-small layui-btn-warm shuaxin" ><i class="iconfont">&#xe656;</i>刷新</button>
					</div>
					<div class="layui-inline">
						<input type="text" name="course_name" placeholder="请输入课程" autocomplete="off" class="layui-input" value="{{@$_GET['course_name']}}">
					</div>
					<!-- <div class="layui-inline">
						<select name="states" lay-filter="status">
							<option value="">请选择一个状态</option>
							<option value="010">正常</option>
							<option value="021">停止</option>
						</select>
					</div> -->
					<button class="layui-btn layui-btn-normal" lay-submit="search" id="search">搜索</button>
				</div>
			</form>
			<div class="layui-form" id="table-list">
				<table class="layui-table" lay-even lay-skin="line">
					<colgroup>
						<col width="50">
						<col>
						<col>
						<col>
						<col>
						<col>
						<col width="250">
					</colgroup>
					<thead>
						<tr>
							<th><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose"></th>
							<th>所属专业</th>
							<th>课程名称</th>
							<th>课程价格</th>
							<th>图片</th>
							<th>描述</th>
							<th>时间</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
						@foreach($courses as $v)
						<tr>
							<td><input type="checkbox" name="" lay-skin="primary" data-id="{{$v->course_id}}"></td>
							<td>{{$v->course_name}}</td>
							<td>{{$v->profession->pro_name}}</td>
							<td>¥ {{$v->course_price}}</td>
							<td>
								<a href="#" class="layui-btn layui-btn-primary layui-btn-mini info-btn" data-id="{{$v->course_id}}">图片详情</a>
								<img id="img-{{$v->course_id}}" src="{{$v->cover_img}}" style="display: none" >
							</td>
							<td>{{$v->course_desc}}</td>
							<td>{{$v->created_at}}</td>
							<td>
								<div class="layui-inline">
									<button class="layui-btn layui-btn-mini layui-btn-normal edit-btn" data-id="{{$v->course_id}}" ><i class="layui-icon">&#xe642;</i>编辑</button>
									<button class="layui-btn layui-btn-mini layui-btn-danger del-btn" data-id="{{$v->course_id}}" ><i class="layui-icon">&#xe640;</i>删除</button>
								</div>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				<div class="page-wrap">
					{{ $courses->links() }}
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
		//查看图片的详情
		$('.info-btn').on('click',function(){
			var course_id = $(this).attr('data-id');
			console.log(course_id);
			layer.open({
			  type: 1,
			  title: false,
			  closeBtn: 0,
			  area: '516px',
			  skin: 'layui-layer-nobg', //没有背景色
			  shadeClose: true,
			  content: $('#img-'+course_id)
			});
			return false;
		});

		//编辑指定的课程信息
		$('.edit-btn').on('click',function(){
			var course_id = $(this).attr('data-id');
			//open
			var index = layer.open({
			      type: 2,
			      title: '新增课程',
			      shadeClose: true,
			      shade: false,
			      maxmin: true, //开启最大化最小化按钮
			      area: ['893px', '600px'],
			      content: '/course/'+course_id+'/edit'
			    });
			layer.full(index);
			return false;
		});
		//删除指定的课程
		$('.del-btn').on('click',function(){
			var course_id = $(this).attr('data-id');
			var _this = $(this);
			//ajax
			$.ajax({
				url:'/course'+'/'+course_id,
				data:'',
				type:'DELETE',
				dataType:'json',
				headers:{
					'X-CSRF-TOKEN':'{{csrf_token()}}'
				},
				success:function(msg){
					if(msg.code == 1){
						_this.parent().parent().parent().remove();
					}
				}
			})
			return false;
		});

		//新增课程
		$('.addBtn').on('click',function(){
			var index = layer.open({
			      type: 2,
			      title: '新增课程',
			      shadeClose: true,
			      shade: false,
			      maxmin: true, //开启最大化最小化按钮
			      area: ['893px', '600px'],
			      content: '/course/create'
			    });
			layer.full(index);
			return false;
		});

		//刷新
		$('.shuaxin').on('click',function(){
			window.location.href = '/course';
			return false;
		});

		//重新键盘监听事件
		$('input').on('keydown',function(data){
			if(data.keyCode == 13){
				$('#search').click();
				return false;
			}
		});
	});
</script>
@endsection