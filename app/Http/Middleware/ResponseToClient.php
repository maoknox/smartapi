<?php

namespace App\Http\Middleware;

use Closure;

class ResponseToClient
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
       	$response= $next($request);
       	if(isset($response->original["status"]) && $response->original["status"]!="success"){
       		return $response;
       	}
       	$responseJson=array();
       	$responseJson["status"]="success";
       	$responseJson["msg"]="OK";
       	$responseJson["data"]=$response->original;
       return $responseJson;
    }
}
