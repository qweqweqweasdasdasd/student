@extends('admin/common/master')
@section('title','老师列表')
@section('my-css')
<link rel="stylesheet" type="text/css" href="/admin/static/admin/css/admin.css" />
@endsection
@section('content')
<div class="wrap-container clearfix">
	<div class="column-content-detail">
		<div class="layui-form" id="table-list">
			<table class="layui-table" lay-even lay-skin="line">
				<thead>
					<tr>
						<th>province</th>
						<th>city</th>
						<th>area</th>
						<th>teacher_address</th>
						<th>teacher_desc</th>
						<th>teacher_email</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>{{$teacher->province}}</td>
						<td>{{$teacher->city}}</td>
						<td>{{$teacher->area}}</td>
						<td>{{$teacher->teacher_address}}</td>
						<td>{{$teacher->teacher_desc}}</td>
						<td>{{$teacher->teacher_email}}</td>
					</tr>
				</tbody>
			</table>	
		</div>
	</div>
</div>
@endsection
@section('my-js')
@endsection