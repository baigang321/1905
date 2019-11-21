<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use Illuminate\Support\Facades\Redis;
class IndexController extends Controller
{
    public function index(){
    	$goods=Goods::all();
    	return view("index.index.index",['goods'=>$goods]);
    }
    public function proinfo(){
    	$id=request()->id;
    	$goods=Goods::where("goods_id",$id)->get();
		$data=Goods::where("goods_id",$id)->first();
        $data=unserialize($data);
    	//dd($data);
    	foreach($goods as $k=>$v){
    		//dd($v['goods_imgs']);
            $goods[$k]['goods_imgs']=explode('|',$v['goods_imgs']);
            $data=serialize([$id]);
            $data=Redis::set("data",$date);
        }
    	//dd($goods);
    	return view("index.index.proinfo",['goods'=>$goods,'data'=>$data]);
    }
}
