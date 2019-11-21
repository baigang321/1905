<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
  <form class="form-horizontal" role="form" method="post" action="{{url('/goods/update/'.$goodsInfo->goods_id)}}" enctype="multipart/form-data">
  @csrf
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 商品名称 </label>

                        <div class="col-sm-9">
                            <input type="text" id="form-field-1" value="{{$goodsInfo->goods_name}}"  class="col-xs-10 col-sm-5" name="goods_name" />
                        </div>
                    </div>

                    <div class="space-4"></div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 价格 </label>

                        <div class="col-sm-9">
                            <input type="text" id="form-field-2" value="{{$goodsInfo->goods_price}}"  class="col-xs-10 col-sm-5" name="goods_price" />
                        </div>
                    </div>

                    <div class="space-4"></div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 库存 </label>

                        <div class="col-sm-9">
                            <input type="text" id="form-field-3" value="{{$goodsInfo->goods_num}}"  class="col-xs-10 col-sm-5" name="goods_num" />
                        </div>
                    </div>
                    <div class="space-4"></div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 详情 </label>

                        <div class="col-sm-9">
                            <textarea name="goods_desc" id="editor">{{$goodsInfo->goods_desc}}</textarea>
                        </div>
                    </div>

                    <div class="space-4"></div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 图片 </label>

                        <div class="col-sm-9">
                            <input type="file" name="goods_img">
                            <img src="{{env('UPLOAD_URL')}}{{$goodsInfo->goods_img}}" width="100px">

                        </div>
                    </div>
<!-- 
                    <div class="space-4"></div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 相册 </label>

                        <div class="col-sm-9">
                            <input type="file" name="myfiles[]" multiple>
                            {volist name="goodsInfo['goods_imgs']" id='v'}
                            <img src="{$v}" width="50px" height="50px">
                            {/volist}
                        </div>
                    </div> -->

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 新品 </label>

                        <div class="col-sm-9">
                                <input type="radio" value="1" name="is_new" checked>是
                                <input type="radio" value="2" name="is_new">否
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 精品 </label>

                        <div class="col-sm-9">
                            <input type="radio" value="1" name="is_best" checked>是
                            <input type="radio" value="2" name="is_best">否
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 热卖 </label>

                        <div class="col-sm-9">
                            <input type="radio" value="1" name="is_hot" checked>是
                            <input type="radio" value="2" name="is_hot">否
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 上架 </label>

                        <div class="col-sm-9">
                            <input type="radio" value="1" name="is_up" checked>是
                            <input type="radio" value="2" name="is_up">否
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 品牌 </label>

                        <div class="col-sm-9">
                             <select name="brand_id">
                            <option value="">--请选择--</option>
                        @foreach ($data as $v)
                            <option value="{{$v->brand_id}}">@php echo str_repeat('&nbsp;&nbsp;',$v['level']*3)@endphp {{$v->brand_name}}</option>
                        @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 分类 </label>

                        <div class="col-sm-9">
                            <select name="cate_id">
                               @foreach ($info as $v)
                    <option value="{{$v->cate_id}}" > @php echo str_repeat('&nbsp;&nbsp;',$v['level']*3)@endphp {{$v->cate_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="clearfix form-actions">
                        <div class="col-md-offset-3 col-md-9">
                            <button class="btn btn-info" type="submit">
                                <i class="icon-ok bigger-110"></i>
                                修改
                            </button>

                            &nbsp; &nbsp; &nbsp;
                            <button class="btn" type="reset">
                                <i class="icon-undo bigger-110"></i>
                                重置
                            </button>
                        </div>
                    </div>

                    <div class="hr hr-24"></div>




                </form>   
</body>
</html>