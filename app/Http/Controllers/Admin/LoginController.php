<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
class LoginController extends Controller
{
    public function login(){
    	return view("admin.login.login");
    }
    public function logindo(){
    	$data=request()->except('_token');
      if (Auth::attempt($data)){
          //认证通过
         return redirect("/brand/index");
      }else{
         return redirect("/login/login")->with('msg',"没有此用户");
      }
}
  public function regdo(){
      $post=request()->except('_token');
      $post['password']=Bcrypt( $post['password']);
      $res=User::create($post);
      return redirect("/login/login");
  }

}
