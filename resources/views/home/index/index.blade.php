@extends('home/common/master')
@section('title','首页')
@section('my-css')
<link rel="stylesheet" href="/home/css/page-learing-index.css" />
@endsection
@section('content')
<body data-spy="scroll" data-target="#myNavbar" data-offset="150">
    <!-- 页面头部 -->
    <!--头部导航-->
    @include('home.common.header')
    <!--banner区-->
    @include('home.common.banner')
    <div class="container">
        <!--左侧列表导航-->
        @include('home.common.left_nav')
        <div class="recommend-list">
            <div class="btn-group btn-group-justified">
            	@foreach($professions as $v)
                <a href="{{url('/').'/'.$v->pro_id}}" class="btn btn-primary">{{$v->pro_name}}</a>
               	@endforeach
            </div>
        </div>
        <div class="conten-list">
            @foreach($courses as $v)
            <div class="conten" id="a">
                <div class="row text-center top">
                    <div class="col-lg-3 text-left" id="Title">{{$v->course_name}}</div>
                    <div class="col-lg-5 ">
                        <div class="btn-group btn-group-justified">
                            <!-- <a href="#" class="btn btn-primary active">热 门</a>
                            <a href="#" class="btn btn-primary">初 级</a>
                            <a href="#" class="btn btn-primary">中 级</a>
                            <a href="#" class="btn btn-primary">高 级</a> -->
                        </div>
                    </div>
                    <div class="col-lg-3 text-right"><a href="{{url('/home/course/detail').'/'.$v->course_id}}" class="btn btn-default ck-all" 
                        target="_blank">查看全部</a></div>
                </div>
                <div class="container cont-list">
                    <div class="cont-list-roll">
                        <div class="next glyphicon glyphicon-chevron-right"></div>
                        <div class="prev glyphicon glyphicon-chevron-left"></div>
                        <div class="cont-list-box">
                            @foreach($v->lessons as $vv)
                            <li class="">
                                <img src="{{$vv->cover_img}}" alt="AA" >
                                <div class="tit">{{$vv->lesson_name}} <span>高</span></div>
                                <div>时长: {{$vv->lesson_duration}}分钟</div>
                                <div>老师: {{$vv->teacher_ids}}</div>
                            </li>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="index-cont-nav">
        <div id="myNavbar" class="collapse navbar-collapse ">
            <div id="myCollapse" class="collapse navbar-collapse">
                <div class="logo-ico"><img src="/home/img/asset-logoIco.png" alt=""></div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#a">编程入门</a></li>
                    <li><a href="#b">数据分析师</a></li>
                    <li><a href="#c">机器学习工程师</a></li>
                    <li><a href="#d">前端开发工程师</a></li>
                    <li><a href="#e">人工智能工程师</a></li>
                    <li><a href="#f">全栈工程师</a></li>
                    <li><a href="#g">iOS工程师</a></li>
                    <li><a href="#h">VR开发者</a></li>
                    <li><a href="#i">深度学习</a></li>
                    <li><a href="#j">商业预测分析师</a></li>
                    <li><a href="#k">Android开发工程师</a></li>
                </ul>
            </div>
        </div>
    </div>

    </div>
    <div class="container">
        <div class="index-bot-video text-center">
            <div class="tit">运作方式</div>
            <div class="row">
                <div class="col-lg-6 text-left">
                    <div class="cont">
                        <p class="tit glyphicon glyphicon-hand-right"> 课程作业</p>
                        <p>每门课程都像是一本互动的教科书，具有预先录制的视频、测验和项目。</p>
                    </div>
                    <div>
                        <p class="tit glyphicon glyphicon-hand-right"> 证书</p>
                        <p>获得正式认证的作业，并与朋友、同事和家人分享您的成功。</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="/home/img/widget-video.jpg" width="500" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- 页面底部 -->
    <div class="gotop">
        <a href="#"><i class="glyphicon glyphicon-pencil"></i><span class="hide">问题反馈</span></a>
        <a href="#top"><i class="glyphicon glyphicon-plane"></i><span class="hide">返回顶部</span></a>
    </div>
    <!--底部版权-->
    @include('home.common.footer')

</body>
@endsection
@section('my-js')
 <script type="text/javascript" src="/home/js/widget-travel-index-nav.js"></script>
    <script>
        $('.cont-list-roll').hover(function() {
            $(this).find('.next,.prev').show();
        }, function() {
            $(this).find('.next,.prev').hide();
        });



        $('.gotop a').hover(function() {
            $(this).find('span').removeClass('hide')
        }, function() {
            $(this).find('span').addClass('hide')
        })
    </script>
    <script src="/home/js/page-learing-index.js"></script>
@endsection