@extends('layouts.shop')
@section('title','注册')
@section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     {{session('msg')}}
     <form action="{{url('login/LoginControllerdo')}}" method="post" class="reg-login">
      @csrf
      <h3>已经有账号了？点此<a class="orange" href="{{url('login')}}">登陆</a></h3>
      <div class="lrBox">
       <div class="lrList"><input type="text" placeholder="输入手机号码或者邮箱号" name="email" id="email"/></div>
       <div class="lrList2"><input type="text" placeholder="输入短信验证码" name="email_verified_at" /> <a href="javascript:;" id="yzm">获取验证码</a></div>
       <div class="lrList"><input type="text" placeholder="设置新密码（6-18位数字或字母）" name="password" /></div>
       <div class="lrList"><input type="text" placeholder="再次输入密码" /></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" value="立即注册" />
      </div>
     </form><!--reg-login/-->
@include('public/footer')
@endsection
<script src="/static/admin/js/jquery.js"></script>
<script>
 
  //点击获取
  $(document).on("click","#yzm",function(){
      //获取邮箱
    var email=$("#email").val();// ***@**.com
    //验证
    var reg=/^\w+@\w+\.com$/;
    if(email==''){
        alert('邮箱必填');
        return false;//exit;
    }else if(!reg.test(email)){
            alert('邮箱格式有误');
            return false;
    }

    //通过ajax技术把邮箱发送给控制器
    $.post(
       "{{url('login/send')}}",
      {email:email,_token:"{{csrf_token()}}"},
      function(res){
          if(res==1){
            alert("成功");
          }else{
            alert("失败");
          }
      }
    );
  })

 

</script>
