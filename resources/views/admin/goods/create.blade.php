<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Document</title>
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css"> 
</head>
<body>
         <form class="form-horizontal" role="form" method="post" action="{{url('/goods/store')}}" enctype="multipart/form-data">
         @csrf
                <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 商品名称 </label>

                        <div class="col-sm-9">
                            <input type="text" id="form-field-1"  class="col-xs-10 col-sm-5" name="goods_name" />
                        </div>
                    </div>

                    <div class="space-4"></div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 价格 </label>

                        <div class="col-sm-9">
                            <input type="text" id="form-field-2" class="col-xs-10 col-sm-5" name="goods_price" />
                        </div>
                    </div>

                    <div class="space-4"></div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 库存 </label>

                        <div class="col-sm-9">
                            <input type="text" id="form-field-3" class="col-xs-10 col-sm-5" name="goods_num" />
                        </div>
                    </div>
                    <div class="space-4"></div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 详情 </label>

                        <div class="col-sm-9">
                            <textarea name="goods_desc" id="editor" ></textarea>
                        </div>
                    </div>

                    <div class="space-4"></div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 图片 </label>

                        <div class="col-sm-9">
                            <input type="file" name="goods_img">
                        </div>
                    </div>

                    <div class="space-4"></div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 相册 </label>

                        <div class="col-sm-9">
                            <input type="file" name="goods_imgs[]" multiple>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 新品 </label>

                        <div class="col-sm-9">
                            <input type="radio" value="1" name="is_new" checked="">是
                            <input type="radio" value="2" name="is_new">否
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 精品 </label>

                        <div class="col-sm-9">
                            <input type="radio" value="1" name="is_best" checked="">是
                            <input type="radio" value="2" name="is_best">否
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 热卖 </label>

                        <div class="col-sm-9"> 
                            <input type="radio" value="1" name="is_hot" checked="">是
                            <input type="radio" value="2" name="is_hot">否
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 上架 </label>

                        <div class="col-sm-9">
                            <input type="radio" value="1" name="is_up" checked="">是
                            <input type="radio" value="2" name="is_up">否
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 品牌 </label>

                        <div class="col-sm-9">
                               <select name="brand_id">
                            <option>--请选择--</option>
                             
                               @foreach ($brandInfo as $v)
                                <option value="{{$v->brand_id}}">{{$v->brand_name}}</option>
                                @endforeach
                             
                        </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 分类 </label>

                        <div class="col-sm-9">
                           <select name="cate_id">
                            <option>--请选择--</option>
                             
                               @foreach($cateInfo as $v)
                                <option value="{{$v->cate_id}}">{{str_repeat('-',$v['level']*3)}}{{$v->cate_name}}</option>
                                {/volist}
                                @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="clearfix form-actions">
                        <div class="col-md-offset-3 col-md-9">
                            <button class="btn btn-info" type="submit">
                                <i class="icon-ok bigger-110"></i>
                                增加
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