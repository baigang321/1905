<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

	<form action="{{url('article/store')}}" method="post" enctype="multipart/form-data">
		@csrf
		<table border="2">
			<tr>
				<td>文章标题</td>
				<td><input type="text" name="title" id="title">
					<b style="color:red">@php echo $errors->first('title') @endphp</b>
				</td>
			</tr>
			<tr>
				<td>文章分类</td>
				<td>
					<select name="c_id" id="c_id">
						<option value="">请选择...</option>
						@foreach ($classification as $v)		
						<option value="{{$v->c_id}}">{{$v->c_name}}</option>
						@endforeach
					</select>
					<b style="color:red">@php echo $errors->first('c_id') @endphp</b>
				</td>
			</tr>
			<tr>
				<td>文章重要性</td>
				<td>	
					<input type="radio" name="importance" value="1" checked="">普通
					<input type="radio" name="importance" value="2" >置顶
					<b style="color:red">@php echo $errors->first('importance') @endphp</b>
				</td>
			</tr>
			<tr>
				<td>是否显示</td>
				<td>
					<input type="radio" name="display" value="1" >显示
					<input type="radio" name="display" value="2" checked>不显示
				</td>
			</tr>
			<tr>
				<td>文章作者</td>
				<td><input type="text" name="author"></td>
			</tr>
			<tr>
				<td>作者email</td>
				<td><input type="text" name="email"></td>
			</tr>
			<tr>
				<td>关键字</td>
				<td><input type="text" name="keyword"></td>
			</tr>
			<tr>
				<td>网页描述</td>
				<td><textarea name="describe"></textarea></td>
			</tr>
			<tr>
				<td>上传文件</td>
				<td><input type="file" name="files"></td>
			</tr>
			<tr>
				<td><input type="button" value="添加" id="tjai"></td>
				<td></td>
			</tr>
		</table>
	</form>
</body>
</html>
<script src="/static/admin/js/jquery.js"></script>
<script>
	// （4）实现添加时js和PHP服务器端验证文章标题,文章分类、文章重要性、是否显示不能为空，正则验证文章标题是中文字母数字下划线(20分)
	$(document).on("blur","#title",function(){
		var _this=$(this);
		var	title=_this.val();
		var reg=/^[\u4e00-\u9fa5\w]{2,12}$/;	
		if(!reg.test(title)){
				_this.parent().addClass("has-error");
				_this.next().text("标题不符合规范,必须是中文字母数字下划线，且不能为空");
				return;
			}else{
				_this.parent().removeClass("has-error");
				_this.next().text("");
			}
			$.post(
				"{{url('article/changValue')}}",
				{title:title,_token:"{{csrf_token()}}"},
				function(res){
					if(res>0){
						_this.parent().addClass("has-error");
						_this.next().text("标题已存在");
						return ;
					}else{
						_this.parent().removeClass("has-error");
						_this.next().text("");
					}
					
				}
				)
	})
	
	var falg=true;
	$(document).on("click","#tjai",function(){
		var title=$("#title").val();
		//console.log(title);
		var reg=/^[\u4e00-\u9fa5\w]{2,12}$/;	
		if(!reg.test(title)){
				$("#title").parent().addClass("has-error");
				$("#title").next().text("标题不符合规范,必须是中文字母数字下划线，且不能为空");
				//alert(1);
				return false;
			}
			
			$.ajax({
			  method: "POST",
			  url: "{{url('article/changValue')}}",
			  data: {title:title,_token:"{{csrf_token()}}"},
			  async:false,
			}).done(function(msg) {
			  	if(msg>0){
						$("#title").parent().addClass("has-error");
						$("#title").next().text("品牌名称已存在");
						falg=false;
					}else{
						$("#title").parent().removeClass("has-error");
						$("#title").next().text("");
					}
			});
			//alert(2);
			if(!falg){
				return false;
			}
			//alert(3);
		 var c_id=$("#c_id").val();
		// console.log(c_id);
		 if(c_id==''){
					$("#c_id").next().text("分类不能为空");
					return false;
		   		}else{
					$("#c_id").next().text("");
		   		}
		
		   $("from").submit();
	})
</script>