<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- <link rel="icon" href="../img/asset-favicon.ico"> -->
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/home/plugins/normalize-css/normalize.css" />
    <link rel="stylesheet" href="/home/plugins/bootstrap/dist/css/bootstrap.css" />
    <!-- <link rel="stylesheet" href="/home/css/page-learing-sign.css" /> -->
    @yield('my-css')
</head>
<body>
@yield('content')
</body>
<script type="text/javascript" src="/home/plugins/jquery/dist/jquery.js"></script>
<script type="text/javascript" src="/home/plugins/bootstrap/dist/js/bootstrap.js"></script>
<script type="text/javascript" src="/home/layer/2.4/layer.js"></script>
<script src="/home/js/page-learing-sign.js"></script>
@yield('my-js')