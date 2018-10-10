@extends('admin/common/master')
@section('title','课程分配')
@section('my-css')
<link rel="stylesheet" type="text/css" href="/admin/static/admin/css/admin.css" />
@endsection
@section('content')
<div style="padding: 20px;">	
<form action="#" method="post" class="layui-form layui-form-pane">
	<input type="hidden" name="teacher_id" value="{{$teacher->teacher_id}}">
    <div class="layui-form-item">
        <label for="name" class="layui-form-label">
            教师名称
        </label>
        <div class="layui-input-inline">
            <input type="text" id="name" name="name" value="{{$teacher->teacher_name}}" 
            autocomplete="off" class="layui-input" >
        </div>
    </div>
    <div class="layui-form-item layui-form-text">
        <label class="layui-form-label">
            拥有课程
        </label>
        <table  class="layui-table layui-input-block">
            <tbody>
                <tr>
                    <td>
                        <div class="layui-input-block">
                            @foreach($course as $k=>$v)
                            <input name="course_id[{{$k}}]" lay-skin="primary" type="checkbox" title="{{$v->course_name}}" value="{{$v->course_id}}" @if(in_array($v->course_id,$courses_arr)) checked @endif> 
                            @endforeach
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="layui-form-item">
    <button class="layui-btn" lay-submit="" lay-filter="add" style="width: 150px;">保存</button>
  </div>
</form>
</div>
@endsection
@section('my-js')
<script src="/admin/static/admin/js/xcity.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
	layui.use(['form','jquery'],function(){
		var $ = layui.jquery,
			form = layui.form();

		form.on('submit(add)',function(data){
            //ajax
            $.ajax({
                url:'/teacher/distribution',
                data:data.field,
                dataType:'json',
                type:'post',
                headers:{
                    'X-CSRF-TOKEN':"{{csrf_token()}}"
                },
                success:function(msg){
                    if(msg.code == 1){
                        parent.window.location.href = '/teacher';
                    }
                }
            });
            return false;
        });
	});
</script>
@endsection