<?php

	/**
	 * Carga todas las opiniones de una pelicula.
	 */

	require 'films.php';
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$body = json_decode(file_get_contents("php://input"), true);

		$result = Films::getFilmOpinions($body['idPelicula']);

		if($result != -1){
			$sistema["estado"] = 1;
			$sistema["opiniones"] = $result;
			print json_encode($sistema);
		}

		else{
			$sistema["estado"] = 2;
			$sistema["msj"] = "Ningun usuario ha dado una opinion sobre esta pelicula.";
			print json_encode($sistema);
		}

	}

?>