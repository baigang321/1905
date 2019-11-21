<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">  
</head>
<boy> 
	<h2>修改管理员</h2>
	@if ($errors->any())
		<div class="alert alert-danger">
		<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
		</ul>
		</div>
		@endif
	<form class="form-horizontal" role="form" action="{{url('/admin/update/'.$data->admin_id)}}"  method="post">
		@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">管理员修改</label>
		<div class="col-sm-10">
			<input type="text" name="admin_account" value="{{$data->admin_account}}" class="form-control" id="firstname" 
				   placeholder="请输入管理员添加">
				  
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">管理员密码</label>
		<div class="col-sm-10">
			<input type="password"  name="admin_pwd" value="{{$data->admin_pwd}}" class="form-control" id="lastname" 
				   placeholder="请输入管理员密码">
				   
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">修改</button>
		</div>
	</div>
	
</form>

</body>
</html>