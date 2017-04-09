<?php

/**
 * Estructura de los usuarios almacenados en la base de datos del servidor
 */

require 'database.php';

class Users{

	function __construct(){}

	// Devuelve en una lista todos los usuarios registrados en el sistema
	public static function getAll(){

		$consulta = "SELECT * FROM Users";

		try{
		
			// Preparo la consulta
			$query = Database::getInstance()->getDb()->prepare($consulta);
			// Lanzo la consulta
			$query->execute();

			// Retorno los datos en un arary
			return $query->fetchAll(PDO::FETCH_ASSOC);
		
		} catch(PDOException $e){

			return false;
		}
	}

	// Devuelve el usuario y la contraseña al dar un email o "false" si existe
	public static function getByEmail($email, $password){

		$consulta = "SELECT user FROM Users WHERE email = ? AND password = ?";

		try{

			$query = Database::getInstance()->getDb()->prepare($consulta);
			$query->execute(array($email, $password));

			// Retorna solo el primer resultado
			return $query->fetch(PDO::FETCH_ASSOC);
		
		} catch(PDOException $e){

			return -1;
		}
	}

	// Inserta un usuario en la base de datos
	public static function insert($email, $user, $password){

		$consulta = "INSERT INTO Users VALUES(?, ?, ?, 0)";

		try{
			$query = Database::getInstance()->getDb()->prepare($consulta);
			$query->execute(array($email,$user,$password));

			return "ok";

		} catch(PDOException $e){

			return -1;
		}
	}

	// Actualiza el usuario según un email
	public static function updateUser($email, $user){

		$consulta = "UPDATE Users SET user = ? WHERE email = ?";

		try{

			$query = Database::getInstance()->getDb()->prepare($consulta);
			$query->execute(array($user, $email));

			return "ok";
		
		} catch(PDOException $e){

			return -1;
		}
	}

	// Actualiza la password según un email
	public static function updatePassword($email, $password){

		$consulta = "UPDATE Users SET password = ? WHERE email = ?";

		try{

			$query = Database::getInstance()->getDb()->prepare($consulta);
			$query->execute(array($password, $email));

			return "ok";
		
		} catch(PDOException $e){

			return -1;
		}
	}

	// Muestra los usuario ordenados alfabéticamente
	public static function listByUserName(){

		$consulta = "SELECT user FROM Users ORDER BY user ASC";

		try{

			$query = Database::getInstance()->getDb()->prepare($consulta);
			$query->execute();

			return $query->fetchAll(PDO::FETCH_ASSOC);
		
		} catch(PDOException $e){

			return -1;
		}
	}

	// Muestra los usuario ordenados por número de películas puntuadas
	public static function listByRatedFilms(){

		$consulta = "SELECT user, ratedFilms FROM Users ORDER BY ratedFilms DESC";

		try{

			$query = Database::getInstance()->getDb()->prepare($consulta);
			$query->execute();

			return $query->fetchAll(PDO::FETCH_ASSOC);
		
		} catch(PDOException $e){

			return -1;
		}
	}
	
}

?>