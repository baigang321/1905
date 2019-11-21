<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">  
	<script src="/static/admin/js/jquery.js"></script>
</head>
<boy> 
	<h2>添加商品品牌</h2>
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
	
	<form class="form-horizontal" role="form" action="{{url('/brand/store')}}" method="post" enctype="multipart/form-data">
		@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">品牌名称</label>
		<div class="col-sm-10">
			<input type="text" name="brand_name" class="form-control" id="firstname" 
				   placeholder="请输入品牌名称">
				   <b style="color:red">@php echo $errors->first('brand_name') @endphp</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌网址</label>
		<div class="col-sm-10">
			<input type="text"  name="brand_url" class="form-control" id="brand_url" 
				   placeholder="请输入品牌网址">
				     <b style="color:red">@php echo $errors->first('brand_url') @endphp</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌LOGO</label>
		<div class="col-sm-10">
			<input type="file" name="brand_logo" class="form-control" id="lastname" 
				   placeholder="请输入品牌LOGO">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌描述</label>
		<div class="col-sm-10">
			<textarea class="form-control" placeholder="请输入品牌描述" rows="3" name="brand_desc"></textarea>
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
			<input type="button" class="btn btn-default" value="添加">
		</div>
	</div>
	
</form>

</body>
</html>

<script>
	
	$(function(){
		$(document).on("blur","#firstname",function(){
			var _this=$(this);
			var brand_name=_this.val();
			//中文
			var reg=/^[\u4e00-\u9fa5\w]{2,12}$/;
			if(!reg.test(brand_name)){
				_this.parent().addClass("has-error");
				_this.next().text("品牌名称不符合规范");
				return;
			}
			$.ajax({
			  method: "POST",
			  url: "{{url('/brand/checkedOnly')}}",
			  data: {brand_name:brand_name,_token:"{{csrf_token()}}"}
			}).done(function(msg) {
			  	if(msg>0){
			  		$("#firstname").parent().addClass("has-error");
					$("#firstname").next().text("品牌名称已存在");
			  	}
			});

		});
		//网址失去焦点
		$("#brand_url").blur(function(){
			var _this=$(this);
			var brand_url=$(this).val();
			var reg=/^https?:\/\/?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/;
			if(!reg.test(brand_url)){
				_this.parent().addClass("has-error");
				_this.next().text("品牌网址不符合规范");
				return;
			}
		});
		$(document).on("click",".btn-default",function(){
			var brand_name=$("#firstname").val();
			var reg=/^[\u4e00-\u9fa5\w]{2,12}$/;
			if(!reg.test(brand_name)){
				$("#firstname").parent().addClass("has-error");
				$("#firstname").next().text("品牌名称不符合规范");
				return;
			}
			var falg=true;
			//唯一
			$.ajax({
			  method: "POST",
			  url: "{{url('/brand/checkedOnly')}}",
			  async:false,
			  data: {brand_name:brand_name,_token:"{{csrf_token()}}"}
			}).done(function(msg) {
			  	if(msg>0){
			  		$("#firstname").parent().addClass("has-error");
					$("#firstname").next().text("品牌名称已存在");
					 falg=false;

			  	}else{
			  		$("#firstname").parent().removeClass("has-error");
					$("#firstname").next().text("");
			  	}

			});
			//alert(flag);
			if(!falg){
				return ;
			}
			// alert(123);
			var brand_url=$("#brand_url").val();
			var reg=/^https?:\/\/?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/;
			if(!reg.test(brand_url)){
				$("#brand_url").parent().addClass("has-error");
				$("#brand_url").next().text("品牌网址不符合规范");
				return;
			}else{
				$("#brand_url").parent().removeClass("has-error");
				$("#brand_url").next().text("");
			}

			$("from").submit();
		})


	})

</script>