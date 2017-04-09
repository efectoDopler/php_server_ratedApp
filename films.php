<?php

require 'database.php';

class Films{

	function __construct(){}

	// Devuelve todas las peliculas
	public static function getAll(){
		
		$consulta = "SELECT id, name, synopsis, img, type FROM Films";

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

	// Devuelve las opiniones de una pelicula
	public static function getFilmOpinions($idPelicula){
		
		$consulta = "SELECT opinion FROM user_rates WHERE id_film = ?";

		try{
			$query = Database::getInstance()->getDb()->prepare($consulta);
			$query->execute(array($idPelicula));

			// Retorno los datos en un arary
			return $query->fetchAll(PDO::FETCH_ASSOC);
		
		} catch(PDOException $e){

			return -1;
		}
	}

	// Devuelve las opiniones de una pelicula
	public static function getFilmRate($idPelicula){
		
		$consulta = "SELECT AVG(rate) FROM user_rates WHERE id_film = ?";

		try{
			$query = Database::getInstance()->getDb()->prepare($consulta);
			$query->execute(array($idPelicula));

			// Retorno los datos en un arary
			return $query->fetchAll(PDO::FETCH_ASSOC);
		
		} catch(PDOException $e){

			return -1;
		}
	}

	// Devuelve las peliculas votadas por un usuario
	public static function getUserFilms($email){
		
		$consulta = "SELECT id_film, rate, opinion FROM user_rates WHERE id_user = ?";

		try{
			$query = Database::getInstance()->getDb()->prepare($consulta);
			$query->execute(array($idPelicula));

			// Retorno los datos en un arary
			return $query->fetchAll(PDO::FETCH_ASSOC);
		
		} catch(PDOException $e){

			return -1;
		}
	}

	// Devuelve las peliculas votadas por un usuario
	public static function setUserOpinion($idPelicula, $email, $rate, $opinion){
		
		$consulta = "INSERT INTO user_rates VALUES (?, ?, ?, ?)";

		try{
			$query = Database::getInstance()->getDb()->prepare($consulta);
			$query->execute(array($idPelicula, $email, $rate, $opinion));

			// Retorno los datos en un arary
			return "ok";
		
		} catch(PDOException $e){

			return -1;
		}
	}

	// Actualiza la puntuacion que ha dado un usuario a una pelicula
	public static function updateFilmRate($idPelicula, $email, $rate){

		$consulta = "UPDATE user_rates SET rate = ? WHERE id_user = ? AND id_film = ?";

		try{

			$query = Database::getInstance()->getDb()->prepare($consulta);
			$query->execute(array($rate, $email, $idPelicula));

			return "ok";
		
		} catch(PDOException $e){

			return -1;
		}
	}

	// Actualiza la opinion que ha dado un usuario a una pelicula
	public static function updateFilmOpinion($idPelicula, $email, $opinion){

		$consulta = "UPDATE user_rates SET opinion = ? WHERE id_user = ? AND id_film = ?";

		try{

			$query = Database::getInstance()->getDb()->prepare($consulta);
			$query->execute(array($opinion, $email, $idPelicula));

			return "ok";
		
		} catch(PDOException $e){

			return -1;
		}
	}

}

?>