<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">  
</head>
<body>
	<h2>商品品牌列表</h2>
	<form>
		<input type="" name="brand_name" value="{{$query['brand_name']??''}}" placeholder="请输入品牌名称">
		<button class="btn btn-danger">搜索</button>
	</form>
	<a class="btn btn-primary"href="{{url('/brand/create')}}">添加页面</a>
	<table class="table">
	<thead>
		<tr>
			<th>品牌ID</th>
			<th>品牌名称</th>
			<th>品牌网址</th>
			<th>品牌LOGO</th>
			<th>品牌描述</th>
			<th>状态</th>
		</tr>
	</thead>
	<tbody>
		@php $i=1 @endphp 
		@foreach ($data as $v)
		<tr @if($i%2==0)  class="success" @else class="danger" @endif>
			<td>{{$v->brand_id}}</td>
			<td>{{$v->brand_name}}</td>
			<td>{{$v->brand_url}}</td>
			<td><img src="{{env('UPLOAD_URL')}}{{$v->brand_logo}}" width="80"></td>
			<td>{{$v->brand_desc}}</td>
			<td><a href="{{url('/brand/edit/'.$v->brand_id)}}" class="btn btn-primary">修改</a>||
				<a href="{{url('/brand/delete/'.$v->brand_id)}}" class="btn btn-danger">删除</a>
			</td>

		</tr>
		@php $i++ @endphp 
		@endforeach
		<!-- <tr class="success">
			<td>产品2</td>
			<td>10/11/2013</td>
			<td>发货中</td>
		</tr>
		<tr  class="warning">
			<td>产品3</td>
			<td>20/10/2013</td>
			<td>待确认</td>
		</tr>
		<tr  class="danger">
			<td>产品4</td>
			<td>20/10/2013</td>
			<td>已退货</td>
		</tr> -->
	</tbody>
</table>
	{{$data->appends($query)->links()}}
</body>
</html>