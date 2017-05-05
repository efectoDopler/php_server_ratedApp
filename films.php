<?php

require 'database.php';

class Films{

	function __construct(){}

	// Devuelve todas las peliculas
	public static function getFilms(){
		
		$consulta = "SELECT DISTINCT id, name, type , synopsis, COALESCE(AVG(rate) , 0) AS rate FROM Films LEFT OUTER JOIN user_rates ON id = id_film GROUP BY id";

		try{
		
			// Preparo la consulta
			$query = Database::getInstance()->getDb()->prepare($consulta);
			// Lanzo la consulta
			$query->execute();

			// Retorno los datos en un arary
			return $query->fetchAll(PDO::FETCH_ASSOC);
		
		} catch(PDOException $e){

			return -1;
		}
	}

	public static function getRate($id){
		$consulta = "SELECT AVG(rate) AS rate FROM user_rates WHERE id_film = ?";

		try{
		
			// Preparo la consulta
			$query = Database::getInstance()->getDb()->prepare($consulta);
			// Lanzo la consulta
			$query->execute(array($id));

			// Retorno los datos en un arary
			return $query->fetch(PDO::FETCH_ASSOC);
		
		} catch(PDOException $e){

			return -1;
		}

	}

	public static function getNumberRates($email){
		$consulta = "SELECT COUNT(*) AS rates FROM user_rates WHERE id_user = ?";

		try{
		
			// Preparo la consulta
			$query = Database::getInstance()->getDb()->prepare($consulta);
			// Lanzo la consulta
			$query->execute(array($email));

			// Retorno los datos en un arary
			return $query->fetch(PDO::FETCH_ASSOC);
		
		} catch(PDOException $e){

			return -1;
		}
	}

	public static function getFilmOpinions($id){
		$consulta = "SELECT opinion FROM user_rates WHERE id_film = ?";

		try{

			// Preparo la consulta
			$query = Database::getInstance()->getDb()->prepare($consulta);
			// Lanzo la consulta
			$query->execute(array($id));

			// Retorno los datos en un arary
			return $query->fetchAll(PDO::FETCH_ASSOC);
		
		} catch(PDOException $e){

			return -1;
		}
	}

	public static function getUserFilms($email){
		$consulta = "SELECT id, name, type, synopsis, rate, opinion FROM Films, user_rates WHERE id = id_film AND id_user = ?";

		try{
		
			// Preparo la consulta
			$query = Database::getInstance()->getDb()->prepare($consulta);
			// Lanzo la consulta
			$query->execute(array($email));

			// Retorno los datos en un arary
			return $query->fetchAll(PDO::FETCH_ASSOC);
		
		} catch(PDOException $e){

			return -1;
		}

	}

	public static function insertOpinion($id, $email, $rate, $opinion){
		$consulta = "INSERT INTO user_rates VALUES(?, ?, ?, ?)";

		try{
			$query = Database::getInstance()->getDb()->prepare($consulta);
			$query->execute(array($id, $email, $rate, $opinion));

			return "ok";

		} catch(PDOException $e){

			return -1;
		}
	}

	public static function updateOpinion($id, $email, $rate, $opinion){
		$consulta = "UPDATE user_rates SET rate = ? , opinion = ? WHERE  id_film = ? AND id_user = ?";

		try{

			$query = Database::getInstance()->getDb()->prepare($consulta);
			$query->execute(array($rate, $opinion, $id, $email));

			return "ok";
		
		} catch(PDOException $e){

			return -1;
		}
	}

	// Prueba para servicios
	public static function getAllOpinion(){
		$consulta = "SELECT * FROM user_rates";

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