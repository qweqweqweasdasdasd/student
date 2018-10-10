@extends('admin/common/master')
@section('title','管理主页')
@section('my-css')
<link rel="stylesheet" type="text/css" href="/admin/static/admin/css/admin.css"/>
@endsection
@section('content')
<div class="main-layout" id='main-layout'>
	<!--侧边栏-->
	<div class="main-layout-side">
		<div class="m-logo">
		</div>
		<ul class="layui-nav layui-nav-tree" lay-filter="leftNav">
		  <li class="layui-nav-item layui-nav-itemed">
		    <a href="javascript:;"><i class="iconfont">&#xe607;</i>教师管理</a>
		    <dl class="layui-nav-child">
		      <dd><a href="javascript:;" data-url="/teacher/create" data-id='1' data-text="后台菜单"><span class="l-line"></span>添加新老师</a></dd>
		      <dd><a href="javascript:;" data-url="/teacher" data-id='2' data-text="前台菜单"><span class="l-line"></span>教师列表</a></dd>
		    </dl>
		  </li>
		  <li class="layui-nav-item">
		    <a href="javascript:;"><i class="iconfont">&#xe608;</i>课程管理</a>
		    <dl class="layui-nav-child">
		      <dd><a href="javascript:;" data-url="/profession" data-id='3' data-text="文章管理"><span class="l-line"></span>专业管理</a></dd>
		      <dd><a href="javascript:;" data-url="/course" data-id='9' data-text="单页管理"><span class="l-line"></span>课程管理</a></dd>
		      <dd><a href="javascript:;" data-url="/lesson" data-id='8' data-text="单页管理"><span class="l-line"></span>课时管理</a></dd>
		    </dl>
		  </li>
		  <li class="layui-nav-item">
		    <a href="javascript:;"><i class="iconfont">&#xe604;</i>推荐位管理</a>
		  </li>
		   <li class="layui-nav-item">
		    <a href="javascript:;"><i class="iconfont">&#xe60c;</i>友情链接</a>
		  </li>
		   <li class="layui-nav-item">
		    <a href="javascript:;"><i class="iconfont">&#xe60a;</i>RBAC</a>
		    <dl class="layui-nav-child">
		      <dd><a href="javascript:;" data-url="/manager" data-id='9' data-text="管理员管理"><span class="l-line"></span>管理员管理</a></dd>
		      <dd><a href="javascript:;" data-url="/role" data-id='3' data-text="角色管理"><span class="l-line"></span>角色管理</a></dd>
		      <dd><a href="javascript:;" data-url="/permission" data-id='4' data-text="权限管理"><span class="l-line"></span>权限管理</a></dd>
		    </dl>
		  </li>
		  <li class="layui-nav-item">
		    <a href="javascript:;" data-url="email.html" data-id='4' data-text="邮件系统"><i class="iconfont">&#xe603;</i>邮件系统</a>
		  </li>
		  <li class="layui-nav-item">
		    <a href="javascript:;"><i class="iconfont">&#xe60d;</i>生成静态</a>
		  </li>
		  <li class="layui-nav-item">
		    <a href="javascript:;"><i class="iconfont">&#xe600;</i>备份管理</a>
		  </li>
		  <li class="layui-nav-item">
		    <a href="javascript:;" data-url="admin-info.html" data-id='5' data-text="个人信息"><i class="iconfont">&#xe606;</i>个人信息</a>
		  </li>
		  <li class="layui-nav-item">
		  	<a href="javascript:;" data-url="system.html" data-id='6' data-text="系统设置"><i class="iconfont">&#xe60b;</i>系统设置</a>
		  </li>
		</ul>
	</div>
	<!--右侧内容-->
	<div class="main-layout-container">
		<!--头部-->
		<div class="main-layout-header">
			<div class="menu-btn" id="hideBtn">
				<a href="javascript:;">
					<span class="iconfont">&#xe60e;</span>
				</a>
			</div>
			<ul class="layui-nav" lay-filter="rightNav">
			  <li class="layui-nav-item"><a href="javascript:;" data-url="email.html" data-id='4' data-text="邮件系统"><i class="iconfont">&#xe603;</i></a></li>
			  <li class="layui-nav-item">
			    <a href="javascript:;" data-url="admin-info.html" data-id='5' data-text="个人信息">{{@\Auth::guard('admin')->user()->mg_name}}</a>
			  </li>
			  <li class="layui-nav-item"><a href="{{url('/logout')}}">退出</a></li>
			</ul>
		</div>
		<!--主体内容-->
		<div class="main-layout-body">
			<!--tab 切换-->
			<div class="layui-tab layui-tab-brief main-layout-tab" lay-filter="tab" lay-allowClose="true">
			  <ul class="layui-tab-title">
			    <li class="layui-this welcome">后台主页</li>
			  </ul>
			  <div class="layui-tab-content">
			    <div class="layui-tab-item layui-show" style="background: #f5f5f5;">
			    	<iframe src="{{url('/welcome')}}" width="100%" height="100%" name="iframe" scrolling="auto" class="iframe" framborder="0"></iframe>
			    </div>
			  </div>
			</div>
		</div>
	</div>
	<!--遮罩-->
	<div class="main-mask">
		
	</div>
</div>
@endsection
@section('my-js')
<script src="/admin/static/admin/js/common.js" type="text/javascript" charset="utf-8"></script>
<script src="/admin/static/admin/js/main.js" type="text/javascript" charset="utf-8"></script>
@endsection
