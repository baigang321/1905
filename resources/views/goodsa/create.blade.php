<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">  
</head>
<boy> 
	<h2>添加商品货物</h2>
	{{session('msg')}}
	<form class="form-horizontal" role="form" action="{{url('/exam/admin/store')}}"  method="post">
		@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">管理员名称</label>
		<div class="col-sm-10">
			<input type="text" name="admin_name" class="form-control" id="firstname" 
				   placeholder="请输入管理员名称">
				  
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">管理员密码</label>
		<div class="col-sm-10">
			<input type="password"  name="admin_pwd" class="form-control" id="lastname" 
				   placeholder="请输入管理员密码">
				   
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">确认密码密码</label>
		<div class="col-sm-10">
			<input type="password"  name="repwd" class="form-control" id="lastname" 
				   placeholder="请输入管理员密码">
				   
		</div>
	</div>
		<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">等级</label>
		<div class="col-sm-10">
			<select name="priv">
				<option value="">-请选择-</option>
				<option value="1">库存主管</option>
				<option value="2">普通库管</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">添加</button>
		</div>
	</div>
	
</form>

</body>
</html>