<?php

	/**
	 * Carga todas las opiniones de una pelicula.
	 */

	require 'films.php';
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$body = json_decode(file_get_contents("php://input"), true);

		$result = Films::getUserFilms($body['email']);

		if($result != -1){
			$sistema["estado"] = 1;
			$sistema["peliculas"] = $result;
			print json_encode($sistema);
		}

		else{
			$sistema["estado"] = 2;
			$sistema["msj"] = "El usuario no ha opinado sobre ninguna pelicula.";
			print json_encode($sistema);
		}

	}

?>