<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<b>留言板</b><br>
	<b>内容</b>
	<form action="{{url('message/index')}}" method="post">
		@csrf
		<textarea name="content"></textarea><br>
		<input type="submit" value="发布">
	</form>
	<table border="2">
		<tr>
			<td>id</td>
			<td>留言内容</td>
			<td>姓名</td>
			<td>时间</td>
			<td>操作</td>
		</tr>
@foreach($message as $v)
		<tr>
			<td>{{$v->id}}</td>
			<td>{{$v->content}}</td>
			<td>{{$v->admin_name}}</td>
			<td></td>
			<td><a href="">删除</a></td>
		</tr>
@endforeach
	</table>
</body>
</html>