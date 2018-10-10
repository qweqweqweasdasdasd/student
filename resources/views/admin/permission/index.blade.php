@extends('admin/common/master')
@section('title','权限')
@section('my-css')
<link rel="stylesheet" type="text/css" href="/admin/static/admin/css/admin.css" />
@endsection
@section('content')
<div class="page-content-wrap">
	<form class="layui-form" action="#">
		<div class="layui-form-item">
			<div class="layui-inline tool-btn">
				<button class="layui-btn layui-btn-small layui-btn-normal addBtn" data-url="menu-add.html"><i class="layui-icon">&#xe654;</i>新增权限</button>
				<button class="layui-btn layui-btn-small layui-btn-warm listOrderBtn" data-url="menu-add.html"><i class="iconfont">&#xe656;</i>刷新</button>
			</div>
		</div>
	</form>
	<div class="layui-form" id="table-list">
		<table class="layui-table" lay-skin="line">
			<colgroup>
				<col width="50">
				<col class="hidden-xs" width="50">
				
				<col class="hidden-xs" width="100">
				<col>
				<col width="80">
				<col width="200">
			</colgroup>
			<thead>
				<tr>
					<th><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose"></th>
					<th class="hidden-xs">ID</th>
				
					<th class="hidden-xs">应用</th>
					<th>菜单名称</th>
					<th>路由</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				@foreach($permissions as $v)
				<tr id='node-{{$v["ps_id"]}}' class="parent collapsed @if($v['ps_pid'] != 0) child-node-{{$v['ps_pid']}} @endif" 
					@if($v['ps_pid'] != 0) style="display: none;" parentid="" @endif
					>
					<td><input type="checkbox" name="" lay-skin="primary" data-id="1"></td>
					<td class="hidden-xs">{{$v['ps_id']}}</td>
					
					<td class="hidden-xs">{{$v['ps_c']}}</td>
					<td>{{str_repeat('├─',$v['level']).$v['ps_name']}}
						@if($v['level'] != 2)
						<a class="layui-btn layui-btn-mini layui-btn-normal showSubBtn" data-id='{{$v['ps_id']}}'>+</a>
						@endif
					</td>
					<td>{{$v['ps_route']}}</td>
					<td>
						<div class="layui-inline">
							<button class="layui-btn layui-btn-mini layui-btn-normal edit-btn" data-id="{{$v['ps_id']}}"><i class="layui-icon">&#xe642;</i>编辑</button>
							<button class="layui-btn layui-btn-mini layui-btn-danger del-btn" data-id="{{$v['ps_id']}}"><i class="layui-icon">&#xe640;</i>删除</button>
						</div>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection
@section('my-js')
<script>
	layui.use(['jquery','form'], function() {
		var $=layui.jquery
			form = layui.form();

		//刷新当前的页面
		$('.listOrderBtn').on('click',function(){
			window.location.href = '/permission';
			return false;
		});
		//删除权限信息
		$('.del-btn').on('click',function(){
			var ps_id = $(this).attr('data-id');
			var _this = $(this);
			//ajax
			$.ajax({
				url:'/permission'+'/'+ps_id,
				data:'',
				dataType:'json',
				type:'DELETE',
				headers:{
					'X-CSRF-TOKEN':'{{csrf_token()}}'
				},
				success:function(msg){
					if(msg.code == 1){
						_this.parent().parent().parent().remove();
					}else if(msg.code == 0){
						layer.alert(msg.error)
					}
				}
			});
			return false;
		});

		//编辑权限信息
		$('.edit-btn').on('click',function(){
			var ps_id = $(this).attr('data-id');
			var index = layer.open({
				      type: 2,
				      title: '编辑权限信息',
				      shadeClose: true,
				      shade: false,
				      maxmin: true, //开启最大化最小化按钮
				      area: ['893px', '600px'],
				      content: '/permission/'+ps_id+'/edit'
				    });
			layer.full(index);
			return false;
		});

		//新增权限信息
		$('.addBtn').on('click',function(){
			var index = layer.open({
			      type: 2,
			      title: '新增权限信息',
			      shadeClose: true,
			      shade: false,
			      maxmin: true, //开启最大化最小化按钮
			      area: ['893px', '600px'],
			      content: '/permission/create'
			    });
			layer.full(index);
			return false;
		});
		//栏目展示隐藏
		$('.showSubBtn').on('click', function() {
			var _this = $(this);
			var id = _this.attr('data-id');
			var parent = _this.parents('.parent');
			var child = $('.child-node-' + id);
			var childAll = $('tr[parentid=' + id + ']');
			if(parent.hasClass('collapsed')) {
				_this.html('-');
				parent.addClass('expanded').removeClass('collapsed');
				child.css('display', '');
			} else {
				_this.html('+');
				parent.addClass('collapsed').removeClass('expanded');
				child.css('display', 'none');
				childAll.addClass('collapsed').removeClass('expanded').css('display', 'none');
				childAll.find('.showSubBtn').html('+');
			}

		})
	});
</script>
@endsection