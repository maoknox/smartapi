<?php

namespace App\Http\Middleware;

use Closure;

class WhiteList
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
        return $next($request);
        // Pre-Middleware Action
        // $ip = $request->ip();
        // if ($ip == "192.168.5.101") {
        //     return $next($request);
        // } else {
        //    abort(403,"Acceso no permitido");
        // }        
    }
}
