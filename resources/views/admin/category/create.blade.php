<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">  
</head>
<boy> 
    <h2>添加品牌分类</h2>
    
    <form class="form-horizontal" role="form" action="{{url('/category/store')}}"  method="post">
        @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">分类名称</label>
        <div class="col-sm-10">
            <input type="text" name="cate_name" class="form-control" id="firstname" 
                   placeholder="请输入分类名称">
                  
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">是否展示</label>
        <div class="col-sm-9">
            <input type="radio" value="1" name="cate_show" checked>是
            <input type="radio" value="2" name="cate_show">否
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">是否在导航栏展示</label>
       <div class="col-sm-9">
            <input type="radio" value="1" name="cate_nav_show" >是
            <input type="radio" value="2" name="cate_nav_show" checked>否
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">父类</label>
            <div class="col-sm-9">
                <select name="parent_id">
                    <option value="">--请选择--</option>
                    @foreach ($cateInfo as $v)
                    <option value="{{$v->cate_id}}">{{str_repeat('-',$v['level'])}}{{$v->cate_name}}</option>
                    @endforeach
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