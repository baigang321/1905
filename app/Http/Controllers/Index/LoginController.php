<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Users;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
	public function LoginControllerdo(){
        $data=request()->except('');//接受用户输入的表单数据
  		
    //     $emailInfo=session('emailInfo');
    //     $user_model=model('User');
    //     //验证邮箱
    //     $reg='/^\w+@\w+\.com$/';
    //     if(empty($data['user_email'])){
    //         $this->error('邮箱必填');
    //     }else if(!preg_match($reg,$data['user_email'])){
    //         $this->error('邮箱格式有误');
    //     }else if($data['user_email']!=$emailInfo['user_email']){
    //         $this->error('发送邮件邮箱与将要注册邮箱不一致');
    //     }else{
    //         $count=$user_model->where('user_email',$data['user_email'])->count();
    //         if($count>0){
    //             $this->error('邮箱已被注册');
    //         }
    //     }

    //     //验证 验证码
    //     if(empty($data['user_code'])){
    //         $this->error('验证码必填');
    //     }else if($data['user_code']!=$emailInfo['code']){
    //         $this->error('验证码错误');
    //     }else if((time()-$emailInfo['send_time'])>300){
    //         $this->error('验证码已失效，五分钟内输入有效');
    //     }

    //     //验证密码
    //     if(empty($data['user_pwd'])){
    //         $this->error('密码必填');
    //     }else if(strlen($data['user_pwd'])<6||strlen($data['user_pwd'])>10){
    //         $this->error('密码允许6-10位之间');
    //     }

    //     if($data['user_pwd1']!=$data['user_pwd']){
    //         $this->error('确认密码必须与密码一致');
    //     }
        	$res=Users::create($data);
       		 if($res){
       		 	return redirect('login')->with('msg',"注册成功");
	        }else{
	           	return redirect('reg')->with('msg',"注册失败");
	        }
    }








    public function send(){
    	$email=request()->email;
        // //验证
        // $reg='/^\w+@\w+\.com$/';
        // if(empty($email)){
        //    return redirect('reg')->with('msg',"邮箱必填");
        // }else if(!preg_match($reg,$email)){
        // 	return redirect('reg')->with('msg',"邮箱格式有误");
 
        // }else{
        // 	$count=User::where("email",$email)->count();
        //     if($count>0){
        //     	return redirect('reg')->with('msg',"邮箱已被注册");

        //     }
        // }
    	// echo $email;
    	// exit;
    	// $email='3255728708@qq.com';
    	$code=rand(100000,999999);
    	// $messages="您正在注册全国最大珠宝商会员,验证码是".$code;
    	$res=$this->sendemail($email,$code);
    	//var_dump($res);exit;
    	if(!$res){
    		echo 1;
    	}else{
    		echo 2;
    	}
    }
     public function sendemail($email,$code){
     	//模板名字email 一个参数
        \Mail::send('index.login.email' , ['code'=>$code] ,function($message)use($email){
        //设置主题
            $message->subject("欢迎注册。。。。。");
        //设置接收方
            $message->to($email);
        });
}

public function logindo(){
		$data=request()->except('_token');
        // $where=[
        //     'email','=',$data['email'],
        //     'password','=',$data['password']
        // ];
		$res=Users::first();
        

      if ($res){
            // $email=['id'=>$data['id']];
           session(["user_id"=>$res]);
          //认证通过
         return redirect("/")->with('msg',"登陆成功");
      }else{
         return redirect("login")->with('msg',"没有此用户");
      }
}















    //纯文字

//     public function sendemail($email,$messages){
//         \Mail::raw('hello' ,function($message)use($email){
//         //设置主题
//             $message->subject("欢迎注册滕浩有限公司");
//         //设置接收方
//             $message->to($email);
//         });

// }
}