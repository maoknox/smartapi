<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDO;
use Exception;
class PruebasController extends Controller{
    public function index(Request $request){
    	$response=array();
    	$response["status"]="success";
    	$response["msg"]="notas";
        // echo "hola";exit();
  //   	$myfile = fopen("/var/www/html/json-pruebas-estudiante.json", "r") or die("Unable to open file!");
		// $response["pruebas"]=json_decode(fread($myfile,filesize("/var/www/html/json-pruebas-estudiante.json")));
		// fclose($myfile);
		// $response=json_encode($response);
    	// return $response;  

                // @IDTipoAlistamiento=:param2,
        $idEstudiante=1170083;
        $idTipoAlitamiento=1;
        $anio=2022;
        try{
            $db = DB::connection();                               
            $stmt = $db->getPdo()->prepare("EXEC BD_OPERACION.dbo.SPR_Obtener_Json_EstudiantePrueba_PendienteporAplicar
                @IDEstudiante=:param1,
                @Anio=:param3,
                @Salida=:salida,
                @Mensaje=:mensaje
            ");     
            $stmt->bindParam(":param1", $idEstudiante);  
            // $stmt->bindParam(":param2", $idTipoAlitamiento);  
            $stmt->bindParam(":param3", $anio);   
            $stmt->bindParam(":salida", $salida,PDO::PARAM_INT,1);
            $stmt->bindParam(":mensaje", $mensaje,PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT,1500);                
            $stmt->execute();   
            $pruebasPorAplicar = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->closeCursor();
            $response["pruebas"]=$pruebasPorAplicar[0];
            return $response;
        }
        catch(Exception $e){
            print_r($e);exit();
            abort(500,$e);
        }


    	return $response;//response()->json($response, 200);
    }
}
