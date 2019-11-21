<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cart;
use App\Goods;
class CartController extends Controller
{
    public function cart(){
    	$goods_id=request()->goods_id;
    	//var_dump($goods_id);
    	$add_price=request()->add_price;
    	$goods_num=request()->goods_num;
    	$user_id=session("user_id");
    	$user_id=$user_id['user_id'];
      
          //dd($user_id);
      $this->addCart($goods_id,$add_price,$goods_num,$user_id);
      
    
    	
    }
    public function addCart($goods_id,$add_price,$goods_num,$user_id){
            $where=[
                ['goods_id','=',$goods_id],
  				['user_id','=',$user_id],
                ['is_del','=',1]
             ];
             ////查询此商品是否存在过
            $info=Cart::where($where)->first();
           // dd($cartInfo);
            if(empty($info)){
                //     //检测库存
                // $result=$this->checkGoodsNum($goods_id,$buy_number);
                // if(empty($result)){
                //     // echo "超过库存";exit();
                //     fail("超过库存");
                // }
                 // 否则
            // 把商品id 购买数量 用户id  添加时间 价格 存储到购物车表中
                $arr=['goods_id'=>$goods_id,
               		  'buy_number'=>$goods_num,
               		  'add_price'=>$add_price,
               		  'user_id'=>$user_id,
               		  'add_time'=>time()];
               $res=Cart::create($arr);
            }else{

                // // //检测库存
                // //  $result=$this->checkGoodsNum($goods_id,$buy_number,$cartInfo['buy_number']);
                // //     if(empty($result)){
                // //          fail("超过库存");
                // // }
                //累加 --修改数据库的库存 时间
                // 把此用户的此商品的购买数量改为   数据库中的购买数量 + 将要购买的数量
                $goods_num=$goods_num+$info['buy_number'];
                $res=Cart::where($where)->update(['buy_number'=>$goods_num,'add_time'=>time()]); 
               }
             if($res){    
                      echo "1";
                }else{  
                    echo "2";
                }
    }
    public function cartdo(){
    	$cart=Cart::get();
	    $where=[
	      ['is_del','=',1]
	    ];
	    $cart=Cart::join("goods","cart.goods_id","=","goods.goods_id")->where($where)->get();
	   
    	return view("index.cart.cart",['cart'=>$cart]);
    }
    public function changNum(){
    	$user_id=session("user_id");
    	$user_id=$user_id['user_id'];
    	$goods_id=request()->goods_id;
    	$buy_number=request()->buy_number;
        $where=[
            ['goods_id','=',$goods_id],
            ['is_del','=',1],
            ['user_id','=',$user_id]
        ];
        $res=Cart::where($where)->update(['buy_number'=>$buy_number]);
      if($res){
      	echo 1;
      }else{
      	echo 2;
      }
    }
    public function getCount(){
    	$goods_id=request()->goods_id;
    	$goods_id=explode(",",$goods_id);
    	//$user_id= $this->getUserId();;
      $where=[
          ['user_id','=',1],
          ['is_del','=',1],

      ];
        // print_r($where);exit;
         $info=Cart::join("goods","cart.goods_id","=","goods.goods_id")->where($where)->whereIn("cart.goods_id",$goods_id)->get();
         // echo ($info);
         // print_r($info->toarray());exit;
         $money=0;
        foreach ($info as $key => $v) {
            $money+=$v['goods_price']*$v['buy_number'];
        }
         echo $money;
    }
    public function getTotal(){
       //价格数据 --单价
      $goods_id=request()->goods_id;
      $goodsWhere=[
          ['goods_id','=',$goods_id]
      ];
     
      $goods_price=Goods::where($goodsWhere)->value("goods_price");
      //数量 购物车数量
      $user_id=session("user_id");
      $user_id=$user_id['user_id'];
      
      $cartWhere=[
          ['goods_id','=',$goods_id],
          ['user_id','=',1],
          ['is_del','=',1]
      ];
      $buy_number=Cart::where($cartWhere)->value("buy_number");
      echo  $goods_price*$buy_number;
    }
    public function del(){
       $goods_id=request()->goods_id;
       $goods_id=explode(',',$goods_id);
       //var_dump($goods_id);
      $user_id=session("user_id");
      $user_id=$user_id['user_id'];
     // var_dump($user_id);
        $where=[
            ['user_id','=',1],
            ['is_del','=',1]
        ];
        $res=Cart::where($where)->whereIn('goods_id',$goods_id)->delete();
        return  $res;
    }
    public function pay(){
       $goods_id=request()->goods_id; 

      $url='cart/pay?goods_id='.$goods_id;
       $user_id=session("user_id");
      $user_id=$user_id['user_id'];
      if(empty($user_id)){
        return redirect("/login".'?url='.$url)->with("msg","请先登陆");
         
      }
      if(empty($goods_id)){
        return redirect("cart/cart")->with("msg","操作错误");
         
      }
    
      $where=[
        ['is_del','=',1],
        ['user_id','=',$user_id],
        
      ];
         $goods_id=explode(',',$goods_id);
      $cartinfo=Cart::join('Goods',"goods.goods_id","=","cart.goods_id")->where($where)->whereIn("cart.goods_id",$goods_id)->get();
      // var_dump($cartinfo);
      if(empty($cartinfo[0])){ 
        return redirect("cart/cart")->with("msg","操作错误");
      }
      $total=0;
      foreach ($cartinfo as $k => $v) {
        $total+=$v['goods_price']*$v['buy_number'];
      }
     //    $address_model=model("Address");
     //    $addressInfo=$address_model->getAddressInfo();
     // $this->getCateInfo();
     // $this->assign("cartinfo",$cartinfo);
     //  $this->assign("addressInfo",$addressInfo);
     //  $this->assign("total",$total);
     return view("index.cart.pay",['cartinfo'=>$cartinfo,'total'=>$total]);

    }

}
