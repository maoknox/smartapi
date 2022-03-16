<?php

namespace Src\Prueba\Infraestructure;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use PDO;
use Exception;
class ObtenerPruebaPorAplicarController extends Controller{
	/**
     * Get test responses
     * 
     * @OA\Get(
     *     path="/v1/api/pruebas/{idEstudiante}",
     *     tags={"responses"},
     *     operationId="obtenerPruebasPorAplicar",
     *		@OA\Parameter(
     *         name="resultados",
     *         in="path",
     *         description="Responses in base 64 encoded",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             format="varchar"
     *         )
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     *		@OA\Response(
     *         response=200,
     *         description="Data processed succesfully"
     *     ),
     *   
     * )
     */
    public function obtenerPruebasPorAplicar(Request $request,$idEstudiante){
    	$response=array();
    	$response["status"]="success";
    	$response["msg"]="OK";  
    	$status=200;     
        try{
            $db = DB::connection();                               
            $stmt = $db->getPdo()->prepare("EXEC BD_OPERACION.dbo.SPR_Obtener_Json_EstudiantePrueba_PendienteporAplicar
                @IDEstudiante=:param1,
                @Salida=:salida,
                @Mensaje=:mensaje
            ");     
            $stmt->bindParam(":param1", $idEstudiante);   
            $stmt->bindParam(":salida", $salida,PDO::PARAM_INT,1);
            $stmt->bindParam(":mensaje", $mensaje,PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT,1500);                
            $stmt->execute();   
            $pruebasPorAplicar = $stmt->fetch(PDO::FETCH_ASSOC);
            $stmt->closeCursor();
            $response["pruebas"]=json_decode($pruebasPorAplicar["jsonSalida"],true);
            if(empty($response["pruebas"])){
                $response["status"]="warning";
		    	$response["msg"]="No existe un estudiante con el id relacionado.";  
		    	$status=404; 
            }
    		return response()->json($response, $status);
        }
        catch(Exception $e){
            abort(500,$e);
        }
    }

}
