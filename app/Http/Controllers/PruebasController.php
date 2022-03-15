<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PruebasController extends Controller{
    public function index(Request $request){
    	$response=array();
    	$response["status"]="success";
    	$response["msg"]="notas";
    	$myfile = fopen("/var/www/html/json-pruebas-estudiante.json", "r") or die("Unable to open file!");
		$response["pruebas"]=json_decode(fread($myfile,filesize("/var/www/html/json-pruebas-estudiante.json")));
		fclose($myfile);
		// $response=json_encode($response);
    	// return $response;    	
    	return $response;//response()->json($response, 200);
    }
}
