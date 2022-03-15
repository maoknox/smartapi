<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ObtenerDataExternaController extends Controller{
    


    public function obtenerResultadosPruebas(Request $Request, $resultados){
    	$resultadosDecode=base64_decode($resultados);
    	$response=array();
    	$response["status"]="sucess";
    	$response["msg"]="OK";
    	return $response; 
    }
}
