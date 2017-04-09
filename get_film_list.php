<?php

	/**
	 * Carga todas las peliculas de la app
	 */

	require 'films.php';
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$body = json_decode(file_get_contents("php://input"), true);

		$result = Films::getAll();

		if($result != -1){
			$sistema["estado"] = 1;
			$sistema["peliculas"] = $result;
			print json_encode($sistema);
		}

		else{
			$sistema["estado"] = 2;
			$sistema["msj"] = "false";
			print json_encode($sistema);
		}

	}

?>