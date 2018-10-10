<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>@yield('title')</title>
		<link rel="stylesheet" type="text/css" href="/admin/static/admin/layui/css/layui.css" />
		@yield('my-css')
	</head>
	<body>
		@yield('content')
	</body>
</html>
<script src="/admin/static/admin/layui/layui.js" type="text/javascript" charset="utf-8"></script>
@yield('my-js')