@extends('home/common/master')
@section('title','支付ok')
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
        <div> &nbsp;&nbsp;恭喜订单为 {{$_GET['out_trade_no']}} 已经支付成功!!</div>
    </div>
</div>

<!--footer导航-->
@include('/home/common/footer')
@endsection