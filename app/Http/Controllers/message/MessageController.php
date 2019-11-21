<?php

namespace App\Http\Controllers\message;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use App\Message;
class MessageController extends Controller
{
    public function create(){
    	return view("message/create");
    }
    public function store(){
    	$data=request()->except("_token");
    	$admin=Admin::where("admin_name",$data['admin_name'])->first();
       // dd($admin);
    	if(!$admin){
    		return redirect("message/create")->with("msg","没有此用户");
    	}
    	if($data['admin_pwd']!=$admin['admin_pwd']){
    		return redirect("message/create")->with("msg","密码错误");	
    	}
        session(['admin'=>$admin]);

   		return redirect("message/index");	
    }
    public function index(){
    	$data=Admin::all();
        $content=request()->all();
        $content['add_time']=$content['add_time']=time();
        $res=Message::create($content);

        $message=Message::all();
         
        //dd($data);
    	return view("message/index",['data'=>$data,'message'=>$message]);
    }
    public function add(){

      
    }
}
