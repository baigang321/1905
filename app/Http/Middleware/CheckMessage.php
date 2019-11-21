<?php

namespace App\Http\Middleware;

use Closure;

class CheckMessage
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
        
        $admin=session("admin");
        dd($admin);
        return $next($request);
    }
}
