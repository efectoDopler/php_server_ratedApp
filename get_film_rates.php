<?php

	/**
	 * Carga todas las opiniones de una pelicula.
	 */

	require 'films.php';
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$body = json_decode(file_get_contents("php://input"), true);

		$result = Films::getFilmRate($body['idPelicula']);

		if($result != -1){
			$sistema["estado"] = 1;
			$sistema["rate"] = $result;
			print json_encode($sistema);
		}

		else{
			$sistema["estado"] = 2;
			$sistema["rate"] = 0;
			print json_encode($sistema);
		}

	}

?>