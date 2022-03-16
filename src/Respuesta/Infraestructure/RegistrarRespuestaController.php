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
    	return $request->all();
    	// $resultadosDecode=base64_decode($resultados);
    	// $response=array();
    	// $response["status"]="sucess";
    	// $response["msg"]="OK";
    	// return $response; 
    }
}
