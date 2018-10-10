<header>
    <div class=" learingHeader">
        <nav class="navbar container">
            <div class="navbar-left"><img src="" alt=""></div>
            <div class="navbar-left">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="{{url('/')}}" target="_blank">首页</a></li>
                    <li><a href="#">课程</a></li>
                    <li><a href="#">职业测评</a></li>
                    <li><a href="#">学习中心</a></li>
                </ul>
            </div>
            <div class="navbar-left"><input type="text" class="input-search" placeholder="输入查询关键词"><input type="submit" class="search-buttom"></div>
            @if(Auth::guard('home')->check())
                <div class="navbar-right">
                    欢迎您 :  {{\Auth::guard('home')->user()->std_name}} 
                    <a href="{{url('/home/student/logout')}}">退出</a>
                    <a href="#">会员中心</a>
                    <a href="{{url('/home/shop/cart_account')}}">去购物车结算</a>
                </div>
                @else
                <div class="navbar-right">
                    <a href="{{url('/home/student/login')}}">登录</a>
                    <a href="{{url('/home/student/register')}}">注册</a>
                    <a href="{{url('/home/shop/cart_account')}}">去购物车结算</a>
                </div>
            @endif  
        </nav>
    </div>
</header>