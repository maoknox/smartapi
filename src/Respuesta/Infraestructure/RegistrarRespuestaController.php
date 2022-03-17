<?php

namespace Src\Respuesta\Infraestructure;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use PDO;
use Exception;
class RegistrarRespuestaController extends Controller{
   /** @OA\Info(title="Obtener data externa", version="0.1") */
    /**
     * Get test responses
     * 
     * @OA\Post(
     *     path="/api/v1/respuesta",
     *     tags={"responses"},
     *     operationId="getTestResponses",
     *      @OA\Parameter(
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
     *      @OA\Response(
     *         response=200,
     *         description="Data processed succesfully"
     *     ),
     *   
     * )
     */

    public function registrarResultadosPruebas(Request $request){
    	$respuestas=json_encode($request->all());
        if(empty($respuestas)){
            abort(400,"Cuerpo vacío");
        }
    	$response=array();
        $response["status"]="success";
        $response["msg"]="OK";  
        $status=200;     
        try{
            $db = DB::connection();                               
            $stmt = $db->getPdo()->prepare("EXEC BD_RESULTADO.dbo.SPR_Registrar_Resultado_DigitalScantron
                @jsonRespuesta=:param1,
                @Salida=:salida,
                @Mensaje=:mensaje
            ");     
            $stmt->bindParam(":param1",$respuestas);   
            $stmt->bindParam(":salida", $salida,PDO::PARAM_INT,1);
            $stmt->bindParam(":mensaje", $mensaje,PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT,1500);                
            $stmt->execute();   
            $stmt->closeCursor(); 
            if($salida!=1){
                $response["status"]="errors";
                $response["msg"]=$mensaje; 
                $status=500;  
            }
                      
            return response()->json($response, $status);
        }
        catch(Exception $e){
            abort(500,$e);
        } 
    }
}
