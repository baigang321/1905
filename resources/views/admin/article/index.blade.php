<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<!-- 实现多条件搜索以分类和文章标题查询功能（文章分类数据从数据库内读取） -->
	<form>
		<input type="text" name="title" placeholder="请输入标题" value="{{$query['title']??''}}">
		<select name="c_name">
			<option value="">请选择...</option>
			@foreach ($classification as $v)	

			@if (isset($query['c_name']) && $v->c_name==$query['c_name'])
				<option value="{{$v->c_name}}" selected="">{{$v->c_name}}</option>
			@else
				<option value="{{$v->c_name}}" >{{$v->c_name}}</option>
			
			@endif
			@endforeach
		</select>
		<input type="submit" value="搜索">
	</form>
	<table border="2">
		<tr>
			<th>ID</th>
			<th>文章标题</th>
			<th>文章分类</th>
			<th>文章重要性</th>
			<th>是否显示</th>
			<th>文章作者</th>
			<th>作者email</th>
			<th>关键字</th>
			<th>网页描述</th>
			<th>图片</th>
			<th>操作</th>
		</tr>
		@foreach ($data as $v)
		<tr id="{{$v->id}}">
			<td>{{$v->id}}</td>
			<td>{{$v->title}}</td>
			<td>{{$v->c_name}}</td>
			<td>
				@if($v['importance']==1)
					普通
				@else
					置顶	
				@endif
			</td>
			<td>
				@if($v['display']==1)
					√
				@else
					×
				@endif
			</td>
			<td>{{$v->author}}</td>
			<td>{{$v->email}}</td>
			<td>{{$v->keyword}}</td>
			<td>{{$v->describe}}</td>
			<td><img src="{{env('UPLOAD_URL')}}{{$v->files}}" width="80"></td>
			<td><a href="javascript:;" class="destroy">删除</a>|
				<a href="{{url('article/edit/'.$v->id)}}">修改</a>

			</td>
		</tr>
		@endforeach
	</table>
	{{ $data->appends($query)->links()}}
</body>
</html>
<script src="/static/admin/js/jquery.js"></script>
<script>
	$(document).on("click",".destroy",function(){
		var _this=$(this);
		    id=_this.parents("tr").attr("id");
		   	$.post(
		   		"{{url('article/destroy')}}",
		   		{id:id,_token:"{{csrf_token()}}"},
		   		function(res){
		   			if(res==1){
		   				location.reload()
		   			}
		   		}

		   	)
	})

</script>