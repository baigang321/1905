<?php

namespace App\Http\Controllers\exam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admina;
class IndexController extends Controller
{
   public function index(){
   	 
   		return view("exam.index");

   }
     public function create(){
  

   		return view("exam.create");
   }
    public function store(){
   		$data=request()->except('_token');
   		if($data['admin_pwd']!=$data['repwd']){
   			return redirect("/exam/admin/create")->with("msg","密码不一致");
   		}
   		unset($data['repwd']);
   		$data['admin_pwd']=encrypt($data['admin_pwd']);
   		$res=Admina::create($data);
   		if($res){
   			return redirect("/exam");
   		}else{
   			return redirect("/exam/admin/create")->with("msg","添加失败");
   		}
   }
   public function lists(){
   		$admin=Admina::get();
   		
   		return view("exam.lists",['admin'=>$admin]);
   }
     public function login(){
    	return view("exam/login");
    }
    public function logindo(){
    	$data=request()->except('_token');
    	$res=Admina::where(["admin_name"=>$data['admin_name']])->first();
    	if(!$res){
    		echo "<script>alert('没有用户');window.history.go(-1);</script>";exit;
    	}
    	//dd($res);
    	if($data['admin_pwd']!=decrypt($res->admin_pwd)){
    		return redirect("exam/login")->with("msg","密码错误");
    	}
    	session(['res'=>$res]);
    	return redirect("/exam");
    }
}
