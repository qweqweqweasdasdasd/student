@extends('admin/common/master')
@section('title','专业管理')
@section('my-css')
<link rel="stylesheet" type="text/css" href="/admin/static/admin/css/admin.css" />
@endsection
@section('content')
<div class="wrap-container clearfix">
		<div class="column-content-detail">
			<form class="layui-form" action="#">
				<div class="layui-form-item">
					<div class="layui-inline tool-btn">
						<button class="layui-btn layui-btn-small layui-btn-normal addBtn" ><i class="layui-icon">&#xe654;</i>添加专业</button>
						<button class="layui-btn layui-btn-small layui-btn-danger delBtn"  ><i class="layui-icon">&#xe640;</i>勾选删除</button>
						<button class="layui-btn layui-btn-small layui-btn-warm listOrderBtn " ><i class="iconfont">&#xe656;</i>刷新</button>
					</div>
					<div class="layui-inline">
						<input type="text" name="pro_name"  placeholder="请输入专业" autocomplete="off" class="layui-input" value="{{@$_GET['pro_name']}}">
					</div>
					<div class="layui-inline">
						<select name="status" lay-filter="status">
							<option value="1" @if($_GET['status'] == 1) selected @endif>正常</option>
							<option value="0" @if($_GET['status'] == 0) selected @endif>隐藏</option>
							<option value="" >空状态</option>
						</select>
					</div>
					<button class="layui-btn layui-btn-normal" lay-submit="search">搜索</button>
				</div>
			</form>
			<div class="layui-form" id="table-list">
				<table class="layui-table" lay-even lay-skin="line">
					<colgroup>
						<col width="50">
						<col class="hidden-xs" width="50">
						
						<col>
						<col class="hidden-xs" width="150">
						<col class="hidden-xs" width="150">
						<col width="80">
						<col width="250">
					</colgroup>
					<thead>
						<tr>
							<th><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose"></th>
							<th class="hidden-xs">ID</th>
							
							<th>名称</th>
							
							<th>状态</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
						@foreach($professions as $v)
						<tr>
							<td><input type="checkbox" name="" lay-skin="primary" data-id="{{$v->pro_id}}"></td>
							<td class="hidden-xs">{{$v->pro_id}}</td>
							
							<td>{{$v->pro_name}}</td>
							
							<td><button class="layui-btn layui-btn-mini @if($v->status == 1) layui-btn-warm @else layui-btn-primary @endif">
								@if($v->status == 1)
								显示
								@else
								隐藏
								@endif
							</button></td>
							<td>
								<div class="layui-inline">
									<button class="layui-btn layui-btn-mini layui-btn-normal edit-btn" data-id="{{$v->pro_id}}"><i class="layui-icon">&#xe642;</i>编辑</button>
									<button class="layui-btn layui-btn-mini layui-btn-danger del-btn" data-id="{{$v->pro_id}}"><i class="layui-icon">&#xe640;</i>删除</button>
								</div>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				<div class="page-wrap">
					
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

		//删除勾选的全部信息
		$('.delBtn').on('click',function(){
			var ids = new Array();
			var child = $('tbody').find('input[type="checkbox"]:checked');
			$.each(child,function(i,item){
				ids.push($(item).attr('data-id'));

			});
			//ajax
			$.ajax({
				url:'/profession/alldel',
				data:{ids:ids},
				dataType:'json',
				type:'post',
				headers:{
					'X-CSRF-TOKEN':'{{csrf_token()}}'
				},
				success:function(msg){
					if(msg.code == 1){
						window.location.href = '/profession';
					}
				}
			});
			return false;
		});

		//全选
		form.on('checkbox(allChoose)', function(data) {
			var child = $(data.elem).parents('table').find('tbody input[type="checkbox"]');
			child.each(function(index, item) {
				item.checked = data.elem.checked;
			});
			form.render('checkbox');
		});

		//编辑当前的页面
		$('.edit-btn').on('click',function(){
			var pro_id = $(this).attr('data-id');
			var index =	layer.open({
				      type: 2,
				      title: '编辑专业',
				      shadeClose: true,
				      shade: false,
				      maxmin: true, //开启最大化最小化按钮
				      area: ['893px', '600px'],
				      content: '/profession/'+pro_id+'/edit'
				    });
			layer.full(index);
			return false;
		});

		//刷新当前的页面
		$('.listOrderBtn').on('click',function(){
			window.location.href = '/profession';
			return false;
		});

		//删除专业信息
		$('.del-btn').on('click',function(){
			var pro_id = $(this).attr('data-id');
			var _this = $(this);
			//ajax
			$.ajax({
				url:'/profession/'+pro_id,
				data:'',
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

		//添加专业
		$('.addBtn').on('click',function(){
			var index =	layer.open({
				      type: 2,
				      title: '添加专业',
				      shadeClose: true,
				      shade: false,
				      maxmin: true, //开启最大化最小化按钮
				      area: ['893px', '600px'],
				      content: '/profession/create'
				    });
			layer.full(index);
			return false;
		});
	});
</script>
@endsection
