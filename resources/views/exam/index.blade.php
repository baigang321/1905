<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<h1>后台主页</h1>
	@if(session('res')->priv!=2)
	<p>
		<a href="{{url('/exam/admin')}}">管理员管理</a>
	</p>
	@endif
	<p>
		<a href="{{url('/exam/goodsa')}}">货物管理</a>
	</p>
	<p>
		<a href="">出入记录管理</a>
	</p>
</body>
</html>