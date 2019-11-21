<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">  
</head>
<body>
	<h2>货物列表<h2>
	<form>
		<input type="" name="brand_name" value="{{$query['brand_name']??''}}" placeholder="请输入品牌名称">
		<button class="btn btn-danger">搜索</button>
	</form>
	<a class="btn btn-primary"href="{{url('/brand/create')}}">添加页面</a>
	<table class="table">
	<thead>
		<tr>
			<th>ID</th>
			<th>用户名称</th>
			<th>用户等级</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
	<!-- 	@foreach ($admin as $v)
		<tr >
			<td>{{$v->admin_id}}</td>
			<td>{{$v->admin_name}}</td>
			<td>@if($v->priv==1)
					库存主管
				@else
					库管员
				@endif
			</td>
			<td><a href="">禁用</a>||
				<a href="">升级为主管</a>
			</td>
		</tr>
		@endforeach
		 -->
	</tbody>
</table>
	
</body>
</html>