<?php
	$router->post('/respuesta', [
	    'middleware' => 'whitelist',
	    'uses' => 'Respuesta\Infraestructure\RegistrarRespuestaController@registrarResultadosPruebas'
	]);
