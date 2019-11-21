<?php

namespace App\Http\Middleware;

use Closure;

class CheckExam
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $res=session("res");
        dd($res);
       if(!$res){
            return  redirect("/exam/login")->with("msg","请登陆");
       }
        return $next($request);
    }
}
