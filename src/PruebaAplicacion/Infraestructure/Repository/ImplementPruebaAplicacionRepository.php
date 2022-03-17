<?php
namespace Src\PruebaAplicacion\Infraestructure\Repository;
use Src\PruebaAplicacion\Domain\PruebaAplicacionRepository;
use DB;
use PDO;
use Exception;
class ImplementPruebaAplicacionRepository implements  PruebaAplicacionRepository{
	public function obtenerPruebaPorAplicar(int $idEstudiante):array{		
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
            $pruebas=json_decode($pruebasPorAplicar["jsonSalida"],true);
            if(empty($pruebas)){
                abort(404,"No existe un estudiante con el id relacionado.");
            }
    		return $pruebas;
        }
        catch(Exception $e){
            abort(500,$e);
        }
	}
}
