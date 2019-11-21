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
     <table class="shoucangtab">
      
      <tr>
        <input type="checkbox" id="allBox" >
       <td width="75%"><span class="hui">购物车共有：<strong class="orange">2</strong>件商品</span></td>
       <td width="25%" align="center" style="background:#fff url(/static/index/images/xian.jpg) left center no-repeat;">
        <span class="glyphicon glyphicon-shopping-cart" style="font-size:2rem;color:#666;"></span>
       </td>
      </tr>
     </table>  
     <div class="dingdanlist">
      @foreach ($cart as $v)
      <table>
         <tr goods_id="{{$v->goods_id}}">
        <td width="4%"><input type="checkbox" class="box">
       </td>
        <td class="dingimg" width="15%"><img src="{{env('UPLOAD_URL')}}{{$v->goods_img}}" /></td>
        <td width="50%">
         <h3>{{$v->goods_name}}</h3>
         <time>下单时间：{{$v->add_time}}</time>
        </td>
        <td align="right" goods_id="{{$v->goods_id}}">

         <div class="c_num" goods_num="{{$v->goods_num}}" goods_id="{{$v->goods_id}}" >
            <input type="button" value="-" class="car_btn_1 less" />
            <input type="text" value="{{$v->buy_number}}" class="car_ipt buy_number"/>  
            <input type="button" value="+" class="car_btn_2 add" />

         </div>
          <a href="javascript:;" class="del">删除</a>
       </td>
       </tr>
       <tr>
        <th colspan="4"><strong class="orange">¥{{$v->goods_price*$v->buy_number}}</strong></th>
       </tr>
          @endforeach
       <tr>
        <td width="100%" colspan="4"><a href="javascript:;" id="allDel">删除选中的商品</a></td>
       </tr>
      </table>
      <table>
      <tr>
       <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></spasn></a></th>
       <td width="50%">总计：<strong class="orange"  id="money">¥0</strong></td>
       <td width="40%"><a href="javascript:;" id="pay" >去结算</a></td>
      </tr>
     </table>
       <script src="/static/admin/js/jquery.js"></script>
      <script>
    $(function(){
        //加号 -- 
        $(document).on("click",".add",function(){
            // 文本框数量+1
            var _this=$(this);
            var buy_number=parseInt(_this.prev("input").val());//文本框的值 购买数量
           //console.log(buy_number);
            var goods_num=parseInt(_this.parent("div").attr("goods_num"));//库存
            var goods_id=_this.parent("div").attr("goods_id");//商品id
           // console.log(goods_id);
                if(buy_number>=goods_num){
                    _this.prev("input").val(goods_num);
                }else{
                    buy_number=buy_number+1;
                    _this.prev("input").val(buy_number);
                }
             // 数据库 ----- 购买数量 =  文本框的值 购买数量 当前点击的数量
                changNum(goods_id,buy_number);
             //给当前行选中
                // checkedTr(_this);
             //获取小计
                getTotal(goods_id,_this);
             //重新获取总价            
                getCount();   
        })
        //减号
        $(document).on("click",".less",function(){
          var _this=$(this);
          var goods_id=_this.parent("div").attr("goods_id");//商品id
          var buy_number=parseInt(_this.next("input").val());
              if(buy_number<=1){
                _this.next("input").val(1);
              }else{
                 buy_number=buy_number-1;
                 _this.next("input").val(buy_number);
              }
                // 数据库 ----- 购买数量 =  文本框的值 购买数量 当前点击的数量
                changNum(goods_id,buy_number);
             //给当前行选中 // 当前行复选框选中
                // checkedTr(_this);
             //获取小计
                getTotal(goods_id,_this);
             //重新获取总价            
                getCount();
        })
       // 失去焦点
       //  验证
          $(document).on("blur",".buy_number",function(){
                var _this=$(this);
                var goods_id=_this.parents("tr").attr("goods_id");
                var buy_number=_this.val();
                var goods_num=_this.parent("div").attr("goods_num");
                var reg=/^\d+$/;
                if (!reg.test(buy_number)||parseInt(buy_number)<=0){
                     _this.val(1);
                }else if(parseInt(buy_number)>=parseInt(goods_num)){
                     _this.val(goods_num);
                }else{
                    buy_number=parseInt(buy_number);
                     _this.val(buy_number);
                }
                   // 数据库 ----- 购买数量 =  文本框的值 购买数量 当前点击的数量
                changNum(goods_id,buy_number);
                //  //给当前行选中 // 当前行复选框选中
                // checkedTr(_this);
                //  //获取小计
                getTotal(goods_id,_this);
                //  //重新获取总价            
                getCount();
        })
     
        //全选
      $(document).on("click","#allBox",function(){
          var _this=$(this);
          var status=_this.prop("checked");
          $(".box").prop("checked",status);
          getCount();
      })
      //单删
      $(document).on("click",".del",function(){
           var _this=$(this);
           //console.log(_this);
           var goods_id=_this.parents("tr").attr("goods_id");//商品id 
           // console.log(goods_id);
                $.get(
                    "{{url('cart/del')}}",
                    {goods_id:goods_id},
                    function(res){
                       // console.log(res);
                        if(res==1){
                          _this.parents("tr").next("tr").remove();
                           _this.parents("tr").remove();
                                getCount(); 
                        }else{
                             alert(res.font);
                        }
                    }
                  )
      })
      // 批删
      $(document).on("click","#allDel",function(){

            var _box=$(".box:checked");
            var goods_id="";
                _box.each(function(index){
                    goods_id+=$(this).parents("tr").attr("goods_id")+',';
                })
                goods_id=goods_id.substr(0,goods_id.length-1);
                 $.get(
                    "{{url('cart/del')}}",
                    {goods_id:goods_id},
                    function(res){
                        if(res){
                            _box.each(function(index){
                                $(this).parents("tr").next("tr").remove();
                               // console.log("res");
                                $(this).parents("tr").remove();
                                $("#money").text("￥0");  
                           })
                        }
                    }
                  )
                
      })
      // 结算
      $(document).on("click","#pay",function(){
            var _box=$(".box:checked");
            var goods_id="";
                _box.each(function(index){
                    goods_id+=$(this).parents("tr").attr("goods_id")+",";
                })
                goods_id=goods_id.substr("0",goods_id.length-1);
                if(goods_id==""){
                    alert("至少选择一件商品进行结算");
                    return false;
                }
              location.href="{{url('cart/pay')}}?goods_id="+goods_id;
      })



        //数据库的值也修改 --// 数据库 ----- 购买数量 =  文本框的值 购买数量 当前点击的数量
        function changNum(goods_id,buy_number){
            $.ajax({
                url:"{{url('cart/changNum')}}",
                type:'get',
                data:{buy_number:buy_number,goods_id:goods_id},
                async:false,
                
            }).done(function(res){
                if(res==2){
                    // alert("错误");
                }
            })
        }
       
        //小计
        function getTotal(goods_id,_this){
            $.get(
                "{{url('cart/getTotal')}}",
                {goods_id:goods_id},
                function(res){
                 console.log(res);
                    console.log(_this.parents("td").next("td").text("￥"+res));

                }


                )
        }
        //总价
         function getCount(){
        
            var _box=$(".box:checked");
            //console.log(_box);
            var goods_id="";
              _box.each(function(index){
                  goods_id+=$(this).parents("tr").attr("goods_id")+',';
              })
             
             goods_id=goods_id.substr("0",goods_id.length-1);
            // console.log(goods_id);
            $.get(
                "{{url('cart/getCount')}}",
                {goods_id,goods_id},
                function(res){
                  // console.log(res);
                     $("#money").text("￥"+res)
                }
              )
         }
    })
</script>
   
@endsection