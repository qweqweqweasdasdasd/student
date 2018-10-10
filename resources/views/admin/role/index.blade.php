@extends('admin/common/master')
@section('title','角色')
@section('my-css')
<link rel="stylesheet" type="text/css" href="/admin/static/admin/css/admin.css" />
@endsection
@section('content')
<div class="page-content-wrap">
	<form class="layui-form" action="#">
		<div class="layui-form-item">
			<div class="layui-inline tool-btn">
				<button class="layui-btn layui-btn-small layui-btn-normal addBtn" ><i class="layui-icon">&#xe654;</i>添加角色</button>
				<button class="layui-btn layui-btn-small layui-btn-danger all-del-Btn" ><i class="layui-icon">&#xe640;</i>删除勾选的角色</button>
			</div>
			<div class="layui-inline">
				<input type="text" name="r" placeholder="请输入角色" autocomplete="off" class="layui-input" value="{{@$_GET['r']}}">
			</div>
			<button class="layui-btn layui-btn-normal search" lay-submit="search">搜索</button>
		</div>
	</form>
	<div class="layui-form" id="table-list">
		<table class="layui-table" lay-even lay-skin="line">
			<colgroup>
				<col width="50">
				<col class="hidden-xs" width="50">
				<col class="hidden-xs" width="100">
				<col class="hidden-xs" width="130">
				<col width="450">
			</colgroup>
			<thead>
				<tr>
					<th><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose"></th>
					<th class="hidden-xs">ID</th>
					<th>角色名称</th>
					<th>创建时间</th>
					
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				@foreach($roles as $k => $v)
				<tr>
					<td><input type="checkbox" name="" lay-skin="primary" data-id="{{$v->r_id}}"></td>
					<td class="hidden-xs">{{$v->r_id}}</td>
					<td>{{$v->r_name}}</td>
					<td>{{$v->created_at}}</td>
					
					<td>
						<div class="layui-inline">
							<button class="layui-btn layui-btn-mini layui-btn-warm  dis-btn" data-id="{{$v->r_id}}" ><i class="layui-icon">&#xe642;</i>权限分配</button>
							<button class="layui-btn layui-btn-mini layui-btn-normal  edit-btn" data-id="{{$v->r_id}}" ><i class="layui-icon">&#xe642;</i>编辑</button>
							<button class="layui-btn layui-btn-mini layui-btn-danger del-btn" data-id="{{$v->r_id}}"><i class="layui-icon">&#xe640;</i>删除</button>
						</div>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<!-- 分页 -->
		<div class="page-wrap">
			{{ $roles->links() }}
		</div>
	</div>
</div>
@endsection
@section('my-js')
<script type="text/javascript">
	layui.use(['form','jquery'],function(){
		var $ = layui.jquery,
			form = layui.form();
		//分配权限
		$('.dis-btn').on('click',function(){
			var r_id = $(this).attr('data-id');
			var index =	layer.open({
			      type: 2,
			      title: '分配权限',
			      shadeClose: true,
			      shade: false,
			      maxmin: true, //开启最大化最小化按钮
			      area: ['893px', '600px'],
			      content: '/role/dis/'+r_id
			    });
			layer.full(index);
			return false;
		});

		//删除勾选的角色
		$('.all-del-Btn').on('click',function(){
			var ids = new Array();
			var child = $('tbody').children('tr').find('input[type="checkbox"]:checked');
			if(!(child.length>0)){
				layer.alert('至少选中一条数据!');
				return false;
			}
			$.each(child,function(i,item){
				var id = $(item).attr('data-id');
				ids.push(id);
			})
			$.ajax({
				url:'/role/alldel',
				data:{ids:ids},
				dataType:'json',
				type:'post',
				headers:{
					'X-CSRF-TOKEN':'{{csrf_token()}}'
				},
				success:function(msg){
					if(msg.code == 1){
						window.location.href = '/role';
					}
				}
			});
			return false;
		});

		//删除角色
		$('.del-btn').on('click',function(){
			var r_id = $(this).attr('data-id');
			var _this = $(this);
			$.ajax({
				url:'/role' + '/' + r_id,
				data:{r_id:r_id},
				dataType:'json',
				type:'delete',
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

		//编辑角色
		$('.edit-btn').on('click',function(){
			var r_id = $(this).attr('data-id');
			
			var index = layer.open({
			      type: 2,
			      title: '编辑角色',
			      shadeClose: true,
			      shade: false,
			      maxmin: true, //开启最大化最小化按钮
			      area: ['893px', '600px'],
			      content: '/role/'+r_id+'/edit'
			    });
			layer.full(index);
			return false;
		});

		//新增角色
		$('.addBtn').click(function(){
			var index = layer.open({
			      type: 2,
			      title: '新增角色',
			      shadeClose: true,
			      shade: false,
			      maxmin: true, //开启最大化最小化按钮
			      area: ['893px', '600px'],
			      content: '/role/create'
			    });
			layer.full(index);
			return false;
		});

		//阻止默认键盘监听事件
		$('input').on('keydown',function(event){
			if(event.keyCode == 13){
				$('.search').click();
				return false;
			}
		});

		//全选
		form.on('checkbox(allChoose)', function(data) {
			var child = $(data.elem).parents('table').find('tbody input[type="checkbox"]');
			child.each(function(index, item) {
				item.checked = data.elem.checked;
			});
			form.render('checkbox');
		});
	});
</script>
@endsection