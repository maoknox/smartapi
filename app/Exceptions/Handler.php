<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

   
     /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */

    public function render($request, Throwable $exception){
        $descripcion=$exception->getMessage();
        $origen=$exception->getFile()." Línea: ".$exception->getLine();
        $tipo="SmartCanada";
        $traza=$exception->getMessage();
        $metodo=$exception->getMessage();   
        $descripcion=$exception->getMessage();
        $instruccion=$request->path();
        if($exception instanceof \Symfony\Component\HttpKernel\Exception\HttpException){                
            $codigo = $exception->getStatusCode();
        }
        else{
            $codigo = "500";               
        } 
        if ($request->is('v1/api/*')) {
            return response()->json([
                "status"=>"error",
                'msg' =>$exception->getMessage(),
            ],$codigo);
        } 
        if ($request->is('api/v1/*')) {
            return response()->json([
                "status"=>"error",
                'msg' =>"Error en la petición.",
            ],$codigo);
        }      
            
        return parent::render($request, $exception);
    }
}
