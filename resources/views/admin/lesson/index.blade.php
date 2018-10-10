@extends('admin/common/master')
@section('title','课时管理')
@section('my-css')
<link rel="stylesheet" type="text/css" href="/admin/static/admin/css/admin.css" />
@endsection
@section('content')
<div class="wrap-container clearfix">
		<div class="column-content-detail">
			<form class="layui-form" action="#">
				<div class="layui-form-item">
					<div class="layui-inline tool-btn">
						<button class="layui-btn layui-btn-small layui-btn-normal addBtn" ><i class="layui-icon">&#xe654;</i>添加课时</button>
						<button class="layui-btn layui-btn-small layui-btn-danger delBtn"  ><i class="layui-icon">&#xe640;</i>勾选删除</button>
						<button class="layui-btn layui-btn-small layui-btn-warm listOrderBtn " ><i class="iconfont">&#xe656;</i>刷新清除</button>
					</div>
					<div class="layui-inline">
						<div class="layui-input-inline">
				            <select name="pro_id" lay-search="" lay-filter="pro">
				                <option value="">请选择专业</option>
				                @foreach($professions as $v)
				                <option value="{{$v->pro_id}}" @if($v->pro_id == $_GET['pro_id']) selected @endif>{{$v->pro_name}}</option>
				                @endforeach
				            </select>
				        </div>
				        <div class="layui-input-inline">
				            <select name="course_id" lay-search="" lay-filter="course">
				                <option value="">请选择课程</option>
				               	@foreach($courses as $v)
				                <option value="{{$v->course_id}}" @if($v->course_id == $_GET['course_id']) selected @endif>{{$v->course_name}}</option>
				                @endforeach
				            </select>
				        </div>
				        <div class="layui-input-inline">
				            <select name="lesson_id" lay-search="">
				                <option value="">请选择课时</option>
				               	@foreach($lessons as $v)
				                <option value="{{$v->lesson_id}}" @if($v->lesson_id == $_GET['lesson_id']) selected @endif>{{$v->lesson_name}}</option>
				                @endforeach
				            </select>
				        </div>
					</div>
					<button class="layui-btn layui-btn-normal" lay-submit="search">搜索</button>
				</div>
			</form>
			<div class="layui-form" id="table-list">
				<table class="layui-table" lay-even lay-skin="line">
					<colgroup>
						<col width="50">
						<col width="180">
						<col width="150">
						<col width="150">
						<col width="250">
					</colgroup>
					<thead>
						<tr>
							<th><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose"></th>
							<th>课时名称</th>
							<th>课程名</th>
							<th>课时时长</th>
							<th>封面图</th>
							<th>老师</th>
							<th>状态</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
						@foreach($lessons as $v)
						<tr>
							<td><input type="checkbox" name="" lay-skin="primary" data-id="{{$v->lesson_id}}"></td>
							<td>{{$v->lesson_name}}</td>
							<td><span class="layui-badge layui-bg-green">{{$v->course_name}}</span></td>
							<td>{{$v->lesson_duration}} 分钟</td>
							<td>
								<button class="layui-btn layui-btn-mini layui-btn-normal check" data-id="{{$v->lesson_id}}">查看图片</button>
								<img src="{{$v->cover_img}}" id="img-{{$v->lesson_id}}" style="display: none">
							</td>
							<td>{{$teacher_arr[$v->teacher_ids]}}</td>
							<td><button class="layui-btn layui-btn-mini  @if($v->status == 1) layui-btn-warm @else layui-btn-primary @endif" data-status='1'>
								@if($v->status == 1)
								正常
								@else
								停播
								@endif
							</button></td>
							<td>
								<div class="layui-inline">
									<button class="layui-btn layui-btn-mini layui-btn-normal edit-btn" data-id="{{$v->lesson_id}}"><i class="layui-icon">&#xe642;</i>编辑</button>
									<button class="layui-btn layui-btn-mini layui-btn-danger del-btn" data-id="{{$v->lesson_id}}"><i class="layui-icon">&#xe640;</i>删除</button>
								</div>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				<div class="page-wrap">
					{{ $lessons->appends([
							'pro_id'=>$data['pro_id'],
							'course_id'=>$data['course_id'],
							'lesson_id'=>$data['lesson_id']
						])->links() }}
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
		//三级课程查询
		form.on('select(course)',function(data){
			var course_id = data.value;
			//ajax
			$.ajax({
				url:'/lesson/getlessonbycourse',
				data:{course_id:course_id},
				dataType:'json',
				type:'post',
				headers:{
					'X-CSRF-TOKEN':'{{csrf_token()}}'
				},
				success:function(msg){
					$('select[name="lesson_id"]').html('');
					var option = '<option value="">请选择课程</option>';
					$.each(msg.lesson,function(i,item){
						option += '<option value="'+item.lesson_id+'">'+item.lesson_name+'</option>';
					});
					$('select[name="lesson_id"]').append(option);
					form.render();
				}
			})
			return false;
		});

		//二级专业查询
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
					$('select[name="course_id"]').html('');
					var option = '<option value="">请选择课程</option>';
					$.each(msg.course,function(i,item){
						option += '<option value="'+item.course_id+'">'+item.course_name+'</option>';
					});
					$('select[name="course_id"]').append(option);
					form.render();
				}
			})
			return false;
		});
		//点击查看
		$('.check').on('click',function(){
			var lesson_id = $(this).attr('data-id');

			//页面层-佟丽娅
			layer.open({
			  type: 1,
			  title: false,
			  closeBtn: 0,
			  area: '516px',
			  skin: 'layui-layer-nobg', //没有背景色
			  shadeClose: true,
			  content: $('#img-'+lesson_id)
			});
		});

		//删除勾选的全部信息
		$('.delBtn').on('click',function(){
			var ids = new Array();
			var child = $('tbody').find('input[type="checkbox"]:checked');
			$.each(child,function(i,item){
				ids.push($(item).attr('data-id'));

			});
			//ajax
			$.ajax({
				url:'/lesson/alldel',
				data:{ids:ids},
				dataType:'json',
				type:'post',
				headers:{
					'X-CSRF-TOKEN':'{{csrf_token()}}'
				},
				success:function(msg){
					if(msg.code == 1){
						window.location.href = '/lesson';
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
			var lesson_id = $(this).attr('data-id');
			var index =	layer.open({
				      type: 2,
				      title: '编辑课时',
				      shadeClose: true,
				      shade: false,
				      maxmin: true, //开启最大化最小化按钮
				      area: ['893px', '600px'],
				      content: '/lesson/'+lesson_id+'/edit'
				    });
			layer.full(index);
			return false;
		});

		//刷新当前的页面
		$('.listOrderBtn').on('click',function(){
			window.location.href = '/lesson';
			return false;
		});

		//删除课时信息
		$('.del-btn').on('click',function(){
			var pro_id = $(this).attr('data-id');
			var _this = $(this);
			//ajax
			$.ajax({
				url:'/lesson/'+pro_id,
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

		//添加课时
		$('.addBtn').on('click',function(){
			var index =	layer.open({
				      type: 2,
				      title: '添加课时',
				      shadeClose: true,
				      shade: false,
				      maxmin: true, //开启最大化最小化按钮
				      area: ['893px', '600px'],
				      content: '/lesson/create'
				    });
			layer.full(index);
			return false;
		});
	});
</script>
@endsection
