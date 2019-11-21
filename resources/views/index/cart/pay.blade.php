@extends('layouts.shop')
@section('title','购物车')
@section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>购物车</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
    <!--  <div class="dingdanlist" onClick="window.location.href='address.html'"> -->
       {{session('msg')}}
      <table>
      <!--  <tr>
        <td class="dingimg" width="75%" colspan="2">新增收货地址</td>
        <td align="right"><img src="/static/index/images/jian-new.png" /></td>
       </tr> -->
       <!-- <tr><td colspan="3" style="height:10px; background:#efefef;padding:0;"></td></tr> -->
       <!-- <tr>
        <td class="dingimg" width="75%" colspan="2">选择收货时间</td>
        <td align="right"><img src="/static/index/images/jian-new.png" /></td>
       </tr> -->
       <!-- <tr><td colspan="3" style="height:10px; background:#efefef;padding:0;"></td></tr> -->
       <tr>
        <td class="dingimg" width="75%" colspan="2">支付方式</td>
        <td align="right"><span class="hui">支付宝支付</span></td>
       </tr>
       <!-- <tr><td colspan="3" style="height:10px; background:#efefef;padding:0;"></td></tr> -->
      <!--  <tr>
        <td class="dingimg" width="75%" colspan="2">优惠券</td>
        <td align="right"><span class="hui">无</span></td>
       </tr> -->
       <!-- tr><td colspan="3" style="height:10px; background:#efefef;padding:0;"></td></tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">是否需要开发票</td>
        <td align="right"><a href="javascript:;" class="orange">是</a> &nbsp; <a href="javascript:;">否</a></td>
       </tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">发票抬头</td>
        <td align="right"><span class="hui">个人</span></td>
       </tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">发票内容</td>
        <td align="right"><a href="javascript:;" class="hui">请选择发票内容</a></td>
       </tr> -->
       <!-- <tr><td colspan="3" style="height:10px; background:#fff;padding:0;"></td></tr> -->
       <!-- <tr>
        <td class="dingimg" width="75%" colspan="3">商品清单</td>
       </tr> -->
       
       <tr>
       <!--  <td class="dingimg" width="15%"><img src="/static/index/images/zf3.jpg" /></td> -->
       <!--  <td width="50%">
         <h3>三级分销农庄有机瓢瓜400g</h3>
         <time>下单时间：2015-08-11  13:51</time>
        </td>
        <td align="right"><span class="qingdan">X 1</span></td>
       </tr>
       <tr>
        <th colspan="3"><strong class="orange">¥36.60</strong></th>
       </tr>
       <tr> -->
    <!--     <td class="dingimg" width="15%"><img src="/static/index/images/zf3.jpg" /></td> -->
        <td width="50%" id="show">
         
          @foreach ($cartinfo as $v)
         <tr goods_id="{$v.goods_id}">
         <h3>{{$v->goods_name}}</h3>
         <img src="{{env('UPLOAD_URL')}}{{$v->goods_img}}" width="100px" height="100px">
         <time>下单时间：{{date('Y-m-d H:i:s',$v->add_time)}}</time>
        </td>
        <td align="right"><span class="qingdan">X {{$v->buy_number}}</span></td>
       </tr>
      
       <tr>
        <th colspan="3"><strong class="orange">¥{{$v->add_price}}</strong></th>
        @endforeach
       </tr>
       </tr>
     <!--   <tr>
        <td class="dingimg" width="75%" colspan="2">商品金额</td>
        <td align="right"><strong class="orange">¥68.80</strong></td>
       </tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">折扣优惠</td>
        <td align="right"><strong class="green">¥0.00</strong></td>
       </tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">抵扣金额</td>
        <td align="right"><strong class="green">¥0.00</strong></td>
       </tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">运费</td>
        <td align="right"><strong class="orange">¥20.80</strong></td>
       </tr> -->

      </table>
      <div class="height1"></div>
    <div class="gwcpiao">
     <table>
      <tr>
       <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
       <td width="50%">总计：<strong class="orange">¥{{$total}}</strong></td>
       <td width="40%"><a href="javascript:;" id="confirmOrder">提交订单</a></td>
      </tr>
     </table>
    </div><!--gwcpiao/-->
    </div><!--maincont-->
  <script src="/static/admin/js/jquery.js"></script>
    <script>
   
        //点击确认订单
        $(document).on('click','#confirmOrder',function(){
            //获取商品id
           var _tr=$("#show").children("tr");
           console.log(_tr);
            var goods_id='';
            _tr.each(function(index){
                goods_id+=$(this).attr("goods_id")+',';
            });
            
           //  goods_id=goods_id.substr(0,goods_id.length-1);
           // console.log(goods_id);
           //  // goods_id=goods_id.substr(0,goods_id.length-1);//字符串对象 函数

           //  //获取选中的收货地址
           //  // var address_id=$(":radio:checked").val();

           //  //获取支付方式
           //  var pay_type=$("li[class='checked']").attr("pay_type");
           //      //console.log(pay_type);
           //  //获取订单留言
           //  var order_talk=$("#order_talk").val();
           // console.log(order_talk);
           // location.href="{:url('order/submitOrder')}?goods_id="+goods_id+"&address_id="+address_id+"&pay_type="+pay_type+"&order_talk="+order_talk;
        })
    </script>
@endsection