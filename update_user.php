<?php

	/**
	 * Actualiza el usuario en la base de datos.
	 */

	require 'users.php';
	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){

		$body = json_decode(file_get_contents("php://input"), true);

		$result = Users::updateUser($body['email'], $body['user']);

		if($result != -1){
			$sistema['estado'] = 1;
			$sistema['msj'] = 'Usuario modificado con exito';
			print json_encode($sistema);
		}

		else{
			$sistema['estado'] = 2;
			$sistema['msj'] = 'Hubo un fallo en el proceso';
			print json_encode($sistema);
		}

	}

?>