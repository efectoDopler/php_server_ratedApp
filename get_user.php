<?php

/**
 * Busca un usuario en la base de datos
 * al introducir un email
 */

	require 'users.php';

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$body = json_decode(file_get_contents("php://input"), true);

		$result = Users::getByEmail($body['email'], $body['password']);

		if($result != -1){
			$sistema["estado"] = 1;
			$sistema["usuario"] = $result;
			print json_encode($sistema);
		}

		else{
			$sistema["estado"] = 2;
			$sistema["msj"] = "false";
			print json_encode($sistema);
		}

	}

?>