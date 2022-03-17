<?php

namespace Src\PruebaAplicacion\Infraestructure;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Src\PruebaAplicacion\Infraestructure\Repository\ImplementPruebaAplicacionRepository;
use Src\PruebaAplicacion\Aplication\ObtenerPruebaPorAplicarPorIdEstudiante;

class ObtenerPruebaPorAplicarController extends Controller{

    private $repository;
    public function __construct(ImplementPruebaAplicacionRepository $repository){
        $this->repository=$repository;
    }


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
    public function obtenerPruebasPorAplicar(Request $request){
        $idEstudiante=(int)$request->idEstudiante;
    	$response=array(); 
        $ObtenerPruebaPorAplicarPorIdEstudiante=new ObtenerPruebaPorAplicarPorIdEstudiante($this->repository);
        $responseJson["status"]="success";
        $responseJson["msg"]="OK";
        $responseJson["pruebas"]=$ObtenerPruebaPorAplicarPorIdEstudiante->__invoke($idEstudiante);
        return response()->json($responseJson,200);
    }

}
