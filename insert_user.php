<?php

	/**
	 * Inserta un usuario nuevo en la base de datos.
	 */

	require 'users.php';
	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){

		$body = json_decode(file_get_contents("php://input"), true);

		$result = Users::insert($body['email'], $body['user'], $body['password']);

		if($result != -1){
			$sistema['estado'] = 1;
			$sistema['msj'] = 'true';
			print json_encode($sistema);
		}

		else{
			$sistema['estado'] = 2;
			$sistema['msj'] = 'false';
			print json_encode($sistema);
		}

	}

?>