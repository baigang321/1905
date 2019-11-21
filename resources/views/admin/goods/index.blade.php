 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
 	<title>Document</title>
 	
 </head>
 <body>
 
 <h1>分类列表展示</h1>
 <h1><a href="{{url('/goods/create')}}">添加页面</a></h1>
 	<table class="table">
	 <thead>
                            <tr>
                                <th>商品id</th>
                                <th>商品名称</th>
                                <th>价格</th>
                                <th>库存</th>
                                <th>图片</th>
                                <th>相册</th>
                                <th>新品</th>
                                <th>精品</th>
                                <th>热卖</th>
                                <th>上架</th>
                                <th>品牌</th>
                                <th>分类</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                             @foreach($data as $v)
                            <tr>
                                <td>{{$v->goods_id}}</td>
                                <td>{{$v->goods_name}}</td>
                                <td>{{$v->goods_price}}</td>
                                <td>{{$v->goods_num}}</td>
                                <td><img src="{{env('UPLOAD_URL')}}{{$v->goods_img}}" width="50px" height="50px"></td>
                                <td>
                                    @foreach($v['goods_imgs'] as $vv)
                                    <img src="{{env('UPLOAD_URL')}}{{$vv}}" width="50px" height="50px">
                                    @endforeach
                                </td>
                                <td>{{$v->is_new}}</td>
                                <td>{{$v->is_best}}</td>
                                <td>{{$v->is_hot}}</td>
                                <td>{{$v->is_up}}</td>
                                <td>{{$v->brand_name}}</td>
                                <td>{{$v->cate_name}}</td>
                                <td>
                     <a href="{{url('/goods/delete/'.$v->goods_id)}}" class="btn  btn-danger">删除</a>
                     <a href="{{url('/goods/edit/'.$v->goods_id)}}" class="btn btn-primary">编辑</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                   
 </body>
 </html>