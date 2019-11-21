<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">  
</head>
<body>
	<h2>管理员列表</h2>
	<form>
		<input type="text" name="admin_account" value="{{$query['admin_account']??''}}" placeholder="请输入管理员名称"><button>搜索</button>
	</form>
	<table class="table">
	<thead>
		<tr>
			<th>编号</th>
			<th>管理员</th>	
			<th>操作</th>	
		</tr>
	</thead>
	@foreach ($data as $v)
	<tbody>		
		<tr>
			<td>{{$v->admin_id}}</td>
			<td>{{$v->admin_account}}</td>
			<td><a href="{{url('admin/delete/'.$v->admin_id)}}">删除</a>||
				<a href="{{url('admin/edit/'.$v->admin_id)}}">修改</a>
			</td>
		</tr>
	@endforeach
	</tbody>
</table>
	{{$data->appends($query)->links()}}
</body>
</html>