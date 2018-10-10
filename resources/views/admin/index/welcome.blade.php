@extends('admin/common/master')
@section('title','管理主页')
@section('my-css')
<link rel="stylesheet" type="text/css" href="/admin/static/admin/css/admin.css"/>
@endsection
@section('content')
<div class="wrap-container welcome-container">
	<div class="row">
		<div class="welcome-left-container col-lg-9">
			<div class="data-show">
				<ul class="clearfix">
					<li class="col-sm-12 col-md-4 col-xs-12">
						<a href="javascript:;" class="clearfix">
							<div class="icon-bg bg-org f-l">
								<span class="iconfont">&#xe606;</span>
							</div>
							<div class="right-text-con">
								<p class="name">会员数</p>
								<p><span class="color-org">89</span>数据<span class="iconfont">&#xe628;</span></p>
							</div>
						</a>
					</li>
					<li class="col-sm-12 col-md-4 col-xs-12">
						<a href="javascript:;" class="clearfix">
							<div class="icon-bg bg-blue f-l">
								<span class="iconfont">&#xe602;</span>
							</div>
							<div class="right-text-con">
								<p class="name">文章数</p>
								<p><span class="color-blue">189</span>数据<span class="iconfont">&#xe628;</span></p>
							</div>
						</a>
					</li>
					<li class="col-sm-12 col-md-4 col-xs-12">
						<a href="javascript:;" class="clearfix">
							<div class="icon-bg bg-green f-l">
								<span class="iconfont">&#xe605;</span>
							</div>
							<div class="right-text-con">
								<p class="name">评论数</p>
								<p><span class="color-green">221</span>数据<span class="iconfont">&#xe60f;</span></p>
							</div>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
@endsection
@section('my-js')
<script src="/admin/static/admin/js/common.js" type="text/javascript" charset="utf-8"></script>
<script src="/admin/static/admin/js/main.js" type="text/javascript" charset="utf-8"></script>
@endsection
