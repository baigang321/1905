<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<h1>登陆</h1>
	{{session('msg')}}
	<form action="{{url('/message/store')}}" method="post">
		@csrf
		<table border="2">	
			<tr>
				<td>用户名</td>
				<td><input type="text" name="admin_name"></td>
			</tr>
			<tr>
				<td>密码</td>
				<td><input type="password" name="admin_pwd"></td>
			</tr>
			<tr>
				<td><input type="submit" value="登陆"></td>
				<td></td>
			</tr>
		</table>
	</form>
</body>
</html>