<?php

namespace Src\PruebaAplicacion\Domain;


interface PruebaAplicacionRepository
{
	public function obtenerPruebaPorAplicar(int $idEstudiante):array;
}




