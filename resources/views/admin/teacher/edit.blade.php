@extends('admin/common/master')
@section('title','老师管理')
@section('my-css')
<link rel="stylesheet" type="text/css" href="/admin/static/admin/css/admin.css" />
@endsection
@section('content')
<div class="wrap-container">
	<form class="layui-form" style="width: 90%;padding-top: 20px;">
		<input type="hidden" name="teacher_id" value="{{$teacher->teacher_id}}">
		<div class="layui-form-item">
			<label class="layui-form-label">老师名称：</label>
			<div class="layui-input-block">
				<input type="text" name="teacher_name"  placeholder="请输入老师的名称" autocomplete="off" class="layui-input" value="{{$teacher->teacher_name}}">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">手机号：</label>
			<div class="layui-input-block">
				<input type="text" name="teacher_phone"  placeholder="请输入手机号" autocomplete="off" class="layui-input" value="{{$teacher->teacher_phone}}">
			</div>
		</div>
		<div class="layui-form-item" id="x-city">
	        <label class="layui-form-label">城市联动：</label>
	        <div class="layui-input-inline">
	        	<input type="hidden" name="province" value="{{$teacher->province}}">
	          <select name="province" lay-filter="province">
	            <option value="">请选择省</option>
	          </select>
	        </div>
	        <div class="layui-input-inline">
	        	<input type="hidden" name="city" value="{{$teacher->city}}">
	          <select name="city" lay-filter="city">
	            <option value="">请选择市</option>
	          </select>
	        </div>
	        <div class="layui-input-inline">
	        	<input type="hidden" name="area" value="{{$teacher->area}}">
	          <select name="area" lay-filter="area">
	            <option value="">请选择县/区</option>
	          </select>
	        </div>
	    </div>
		<div class="layui-form-item">
			<label class="layui-form-label">详细地址：</label>
			<div class="layui-input-block">
				<input type="text" name="teacher_address"  placeholder="请输入详细地址" autocomplete="off" class="layui-input" value="{{$teacher->teacher_address}}">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">邮箱：</label>
			<div class="layui-input-block">
				<input type="text" name="teacher_email"  placeholder="请输入邮箱" autocomplete="off" class="layui-input" value="{{$teacher->teacher_email}}">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">头像上传：</label>
			<div class="layui-input-block">
				<input type="file" name="file" class="layui-upload-file">
			</div>
			<div id="image">
				<img src="{{$teacher->teacher_pic}}" width="100px;" style="position:relative;left:100px;top: 10px;">
				<input type="hidden" name="teacher_pic" value="{{$teacher->teacher_pic}}">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">状态：</label>
			<div class="layui-input-block">
				<input type="radio" name="status" value="1" title="显示" @if($teacher->status == 1) checked @endif>
				<input type="radio" name="status" value="2" title="离职" @if($teacher->status == 2) checked @endif>
			</div>

		</div>
		<div class="layui-form-item layui-form-text">
			<label class="layui-form-label">备注：</label>
			<div class="layui-input-block">
				<textarea name="teacher_desc" placeholder="请输入内容" class="layui-textarea">{{$teacher->teacher_desc}}</textarea>
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
<script src="/admin/static/admin/js/xcity.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
	layui.use(['form','jquery','upload'],function(){
		var $ = layui.jquery,
			upload = layui.upload,
			form = layui.form();

		layui.upload({
			url: '/upload/images',
			accept: 'images',
			method: 'post',
			success: function(res) {
				if(res.code == 1){
					$('#image').html('');
					var img = '<img src="'+res.path_url+'" width="100px;" style="position:relative;left:100px;top: 10px;">';
					var input = '<input type="hidden" name="teacher_pic" value="'+res.path_url+'">';
					$('#image').append(img);
					$('#image').append(input);
				}
				console.log(res); //上传成功返回值，必须为json格式
			}
		});

		//表单提交监听
		form.on('submit(formDemo)',function(data){
			var teacher_id = $('input[name="teacher_id"]').val();
			//ajax
			$.ajax({
				url:'/teacher'+'/'+teacher_id,
				data:data.field,
				dataType:'json',
				type:'PATCH',
				headers:{
					'X-CSRF-TOKEN':'{{csrf_token()}}'
				},
				success:function(msg){
					if(msg.code == 1){
						parent.window.location.href = '/teacher';
					}
				},
				error:function(jqXHR, textStatus, errorThrown){
					var msg = '';
					$.each(jqXHR.responseJSON,function(i,item){
						msg += item;
					});
					if(msg != ''){
						layer.alert(msg);
					}
				}

			})
			return false;
		});
		
		//转默认值
		$.fn.xcity = function(pName,cName,aName){
			var p = $(this).find('select[lay-filter="province"]');
			var c = $(this).find('select[lay-filter="city"]');
			var a = $(this).find('select[lay-filter="area"]');
			var cityList = [];
    		var areaList = [];

    		showP(provinceList);
    		showC(cityList);
    		showA(areaList);
			//方法
			function showP(provinceList) {
				p.html('');
				is_pName = false;
				console.log(pName);
				for (var i in provinceList) {
					if(pName == provinceList[i].name){
						is_pName = true;
						cityList = provinceList[i].cityList;
						console.log(cityList);
						p.append("<option selected value='"+provinceList[i].name+"'>"+provinceList[i].name+"</option>")
					}else{
						p.append("<option value='"+provinceList[i].name+"'>"+provinceList[i].name+"</option>")
					}
				}
				if(!is_pName){
					cityList = provinceList[0].cityList;
				}
			}
			function showC( 
		        ) {

		        c.html('');

		        is_cName = false;

		        for (var i in cityList) {
		            if(cName==cityList[i].name){
		                is_cName = true;
		                areaList = cityList[i].areaList;
		                c.append("<option selected value='"+cityList[i].name+"'>"+cityList[i].name+"</option>")
		            }else{
		                c.append("<option value='"+cityList[i].name+"'>"+cityList[i].name+"</option>")
		            }
		        }

		        if(!is_cName){
		            areaList = cityList[0].areaList;
		        }
		    }

		    function showA(areaList) {
		        a.html('');

		        for (var i in areaList) {
		            
		            if(aName==areaList[i]){
		                a.append("<option selected value='"+areaList[i]+"'>"+areaList[i]+"</option>")
		            }else{
		                a.append("<option value='"+areaList[i]+"'>"+areaList[i]+"</option>")
		            }
		        }
		    }

			form.render('select');
			form.on('select(province)', function(data){
		        pName = data.value;
		        showP(provinceList);
		        showC(cityList);
		        showA(areaList);
		        form.render('select');
		    });

		    form.on('select(city)', function(data){
		        cName = data.value;
		        showC(cityList);
		        showA(areaList);
		        form.render('select');
		    });
		}
		//获取省-市-区	//建议使用三目运算
		var province = $('input[name="province"]').val();
		var city = $('input[name="city"]').val();
		var area = $('input[name="area"]').val();

		$('#x-city').xcity(province,city,area);
	});
</script>
@endsection