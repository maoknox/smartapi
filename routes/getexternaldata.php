<?php
	$router->get('/obtenerrespuestas/{resultados}', [
	    'middleware' => 'whitelist',
	    'uses' => 'ObtenerDataExternaController@obtenerResultadosPruebas'
	]);
