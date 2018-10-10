@extends('home/common/master')
@section('title','结算')
@section('my-css')
<link rel="stylesheet" href="/home/css/page-learing-pay.css" />
@endsection
@section('content')
<body data-spy="scroll" data-target="#myNavbar" data-offset="150">
<!--头部导航-->
@include('/home/common/header')
<!--主体内容-->
<div class="container">
    <div class="learing-pay">
        <table style="width:100%;" >
                @foreach($cartinfo as $v)
                <tr>
                    <td width="30%"><img src="{{$course_img[$v['course_id']]}}" alt="" width="160" height="90"/></td>
                    <td width="30%">{{$v['course_name']}}</td>
                    <td width="15%">{{$v['course_price']}}</td>
                    <td width="*"><a href="" class="btn btn-primary">删除</a></td>
                </tr>
                @endforeach
        </table>
    </div>

    <div class="learing-pay" style="margin:20px 0;">
        <div>已经选择了{{$number_price['number']}}个商品</div>
        <div>总价格为：{{$number_price['price']}} 元</div>
        <br>
        <div><a href="{{url('home/shop/cart_jiesuan')}}" class="btn btn-primary" style="display:inline;">去结算</a></div>
    </div>
</div>

<!--footer导航-->
@include('/home/common/footer')
@endsection