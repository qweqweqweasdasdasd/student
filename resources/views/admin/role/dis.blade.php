@extends('admin/common/master')
@section('title','分配权限')
@section('my-css')
<link rel="stylesheet" type="text/css" href="/admin/h-ui/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/admin/h-ui/static/h-ui.admin/css/H-ui.admin.css" />
@endsection
@section('content')
<article class="page-container">
	<form class="form form-horizontal" id="form-admin-role-add">
		<input type="hidden" name="r_id" value="{{$role->r_id}}">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-1">角色名称：</label>
			<div class="formControls col-xs-8 col-sm-10">
				<input type="text" class="input-text" value="{{$role->r_name}}" placeholder="" >
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-1">权限列表：</label>
			<div class="formControls col-xs-8 col-sm-10">
				@foreach($permission_0 as $v)
				<dl class="permission-list">
					<dt>
						<label>
							<input type="checkbox" value="{{$v->ps_id}}" name="ps_id[]"  @if(in_array($v->ps_id,$ps_ids_arr)) checked @endif>
							{{$v->ps_name}}</label>
					</dt>
					<dd>
						@foreach($permission_1 as $vv)
						@if($vv->ps_pid == $v->ps_id)
						<dl class="cl permission-list2">
							<dt>
								<label class="">
									<input type="checkbox" value="{{$vv->ps_id}}" name="ps_id[]" @if(in_array($vv->ps_id,$ps_ids_arr)) checked @endif>
									{{$vv->ps_name}}</label>
							</dt>
							<dd>
								@foreach($permission_2 as $vvv)
								@if($vvv->ps_pid == $vv->ps_id)
								<label class="">
									<input type="checkbox" value="{{$vvv->ps_id}}" name="ps_id[]" @if(in_array($vvv->ps_id,$ps_ids_arr)) checked @endif>
									{{$vvv->ps_name}}</label>
								@endif
								@endforeach
							</dd>
						</dl>
						@endif
						@endforeach
					</dd>
				</dl>
				@endforeach
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<button type="submit" class="btn btn-success radius" ><i class="icon-ok"></i> 确定</button>
			</div>
		</div>
	</form>
</article>
@endsection
@section('my-js')
<script type="text/javascript" src="/admin/h-ui/lib/jquery/1.9.1/jquery.js"></script> 
<script type="text/javascript" src="/admin/h-ui/lib/layer/2.4/layer.js"></script>
<script type="text/javascript">
//提交
$('#form-admin-role-add').submit(function(evt){
	evt.preventDefault();
	var shuju = $(this).serialize();
	//至少选中一个
	if($('input:checked').length < 1){
		layer.alert('至少选中一个');
		return false;
	}
	//ajax
	$.ajax({
		url:'/role/dis',
		data:shuju,
		dataType:'json',
		type:'post',
		headers:{
			'X-CSRF-TOKEN':'{{csrf_token()}}'
		},
		success:function(msg){
			if(msg.code == 1){
				parent.window.location.href = '/role';
			}
		}
	})
});

$(".permission-list dt input:checkbox").click(function(){
	$(this).closest("dl").find("dd input:checkbox").prop("checked",$(this).prop("checked"));
});
$(".permission-list2 dd input:checkbox").click(function(){
	var l =$(this).parent().parent().find("input:checked").length;
	var l2=$(this).parents(".permission-list").find(".permission-list2 dd").find("input:checked").length;
	if($(this).prop("checked")){
		$(this).closest("dl").find("dt input:checkbox").prop("checked",true);
		$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",true);
	}
	else{
		if(l==0){
			$(this).closest("dl").find("dt input:checkbox").prop("checked",false);
		}
		if(l2==0){
			$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",false);
		}
	}
});
</script>
@endsection