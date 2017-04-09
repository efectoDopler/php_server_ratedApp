<?php

	/**
	 * Inserta un usuario nuevo en la base de datos.
	 */

	require 'users.php';
	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){

		$body = json_decode(file_get_contents("php://input"), true);


		if($body['option'] == "name"){

			$result = Users::listByUserName();
		}

		else if($body['option'] == "ratedFilms"){

			$result = Users::listByRatedFilms();
		}
		

		if($result != -1){
			$sistema['estado'] = 1;
			$sistema['usuarios'] = $result;
			print json_encode($sistema);
		}

		else{
			$sistema['estado'] = 2;
			$sistema['msj'] = 'Hubo un fallo en el proceso';
			print json_encode($sistema);
		}

	}

?>