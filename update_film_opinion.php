<?php

	/**
	 * Inserta un usuario nuevo en la base de datos.
	 */

	require 'films.php';
	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){

		$body = json_decode(file_get_contents("php://input"), true);

		$result = Films::updateFilmOpinion($body['idPelicula'], $body['email'], $body['opinion']);

		if($result != -1){
			$sistema['estado'] = 1;
			$sistema['msj'] = 'Opinion modificada con exito';
			print json_encode($sistema);
		}

		else{
			$sistema['estado'] = 2;
			$sistema['msj'] = 'Hubo un fallo en el proceso';
			print json_encode($sistema);
		}

	}

?>