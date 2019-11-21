@extends('layouts.shop')
@section('title','展示')
@section('content')

     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>产品详情</h1>
      </div>
     </header>
     <div id="sliderA" class="slider">
      <img src="{{env('UPLOAD_URL')}}{{$data['goods_img']}}" />
      </div><!--sliderA/ -->
   
     <table class="jia-len">
      <tr>
       <th><strong class="orange">￥{{$data->goods_price}}</strong></th>
       <td>
        <input type="text" class="spinnerExample" value="1" />
        <input type="hidden" id="goods_id" value="{{$data->goods_id}}">
        <input type="hidden" id="add_price" value="{{$data->goods_price}}">
       

       </td>
      </tr>
      <tr>
       <td>
        <strong>{{$data->goods_name}}</strong>
        <p class="hui">{{$data->goods_desc}}</p>
       </td>
       <td align="right">
        <a href="javascript:;" class="shoucang"><span class="glyphicon glyphicon-star-empty"></span></a>
       </td>
      </tr>
     </table>
     <div class="height"></div>
     <h3 class="proTitle">商品规格</h3>
     <ul class="guige">
      <li class="guigeCur"><a href="javascript:;">50ML</a></li>
      <li><a href="javascript:;">100ML</a></li>
      <li><a href="javascript:;">150ML</a></li>
      <li><a href="javascript:;">200ML</a></li>
      <li><a href="javascript:;">300ML</a></li>
      <div class="clearfix"></div>
     </ul><!--guige/-->
     <div class="height2"></div>
     <div class="zhaieq">
      <a href="javascript:;" class="zhaiCur">商品简介</a>
      <a href="javascript:;">商品参数</a>
      <a href="javascript:;" style="background:none;">订购列表</a>
      <div class="clearfix"></div>
     </div><!--zhaieq/-->
     <div class="proinfoList">
        @foreach($goods as $k=>$v)
         @foreach($v['goods_imgs'] as $vv)
         <img src="{{env('UPLOAD_URL')}}{{$vv}}" width="200px" height="200px">
         @endforeach
           @endforeach
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息....
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息......
     </div><!--proinfoList/-->
     <table class="jrgwc">
      <tr>
       <th>
        <a href="index.html"><span class="glyphicon glyphicon-home"></span></a>
       </th>
       <td><button type="button" class="btn btn-info" id="jairu">加入购物车</button></td>
      </tr>
     </table>
    <script src="/static/admin/js/jquery.js"></script>
     <script>
      $(function(){
        $(document).on("click","#jairu",function(){
        var goods_num=$('.spinnerExample').val();
        var goods_id=$('#goods_id').val();
        var add_price=$('#add_price').val();
        //console.log(add_price);
          $.ajax({
              type: "get",
              url: "{{url('/cart/cart')}}",
              data: {goods_id:goods_id,goods_num:goods_num,add_price:add_price}
          }).done(function( msg ) {
            // console.log(msg);
            if (msg==1) {
               alert("加入购物车成功");
                location.href="{{url('cart/cartdo')}}";
              }else{
                 alert("加入购物车失败");
                location.href="{{url('index/login')}}";
              }
          });
        })
        })
       
   
    </script>
  
@include('public/footer')
@endsection