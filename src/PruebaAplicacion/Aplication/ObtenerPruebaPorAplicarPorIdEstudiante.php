<?php
namespace Src\PruebaAplicacion\Aplication;
use Src\PruebaAplicacion\Domain\PruebaAplicacionRepository;

final class ObtenerPruebaPorAplicarPorIdEstudiante{
	private $repository;
	public function __construct(PruebaAplicacionRepository $repository){
		$this->repository=$repository;
	}

	public function __invoke(int $idEstdiante):array{
		return $this->repository->obtenerPruebaPorAplicar($idEstdiante);
	}
}