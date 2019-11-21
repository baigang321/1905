<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
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
        session(['users'=>null]);
        // $user =session("user");
        // echo 111;
        // dd($user);
        // if(!$user){
        //     return redirect('/');
        // }
        if (!$request->session()->has('loginInfo')) {
             return redirect('/login/login');
         }
         return $next($request);
    }
}
