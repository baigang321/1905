<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">  
</head>
<boy> 
	<h2>修改商品品牌</h2>
	<!-- 提示 -->
	<!-- @if ($errors->any())
	<div class="alert alert-danger">
	<ul>
	@foreach ($errors->all() as $error)
	<li>{{ $error }}</li>
	@endforeach
	</ul>
	</div>
	@endif -->
<!-- Create Post Form -->
	
	<form class="form-horizontal" role="form" action="{{url('/brand/update/'.$data->brand_id)}}" method="post" enctype="multipart/form-data">
		@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">品牌名称</label>
		<div class="col-sm-10">
			<input type="text" name="brand_name" value="{{$data->brand_name}}" class="form-control" id="firstname" 
				   placeholder="请输入品牌名称">
				   <b style="color:red">@php echo $errors->first('brand_name') @endphp</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌网址</label>
		<div class="col-sm-10">
			<input type="text"  name="brand_url" value="{{$data->brand_url}}" class="form-control" id="lastname" 
				   placeholder="请输入品牌网址">
				     <b style="color:red">@php echo $errors->first('brand_url') @endphp</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌LOGO</label>
		<div class="col-sm-10">
			<img src="{{env('UPLOAD_URL')}}{{$data->brand_logo}}" width="80">
			<input type="file" name="brand_logo"  class="form-control" id="lastname" >
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌描述</label>
		<div class="col-sm-10">
			<textarea class="form-control" placeholder="请输入品牌描述" rows="3" name="brand_desc">{{$data->brand_desc}}</textarea>
		</div>
	</div>
	<!-- <div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<div class="checkbox">
				<label>
					<input type="checkbox"> 请记住我
				</label>
			</div>o
		</div>
	</div> -->
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">修改</button>
		</div>
	</div>
	
</form>

</body>
</html>