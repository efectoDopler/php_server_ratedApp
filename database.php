<?php

/**
 * Instancia un objeto de la clase PDO
 * para gestionar el uso de la bd
 */

class Database{

	/**
	 * Tanto db como pdo serán una sola
	 * instancia imitando el patrón Singleton.
	 */

	private static $db = null;
	private static $pdo;

	final private function __construct(){
		
		try{
			self::getDb(); //Creo una conexión PDO
		} CATCH (PDOException $e){
			//Control de excepciones.
		}

	}

	
	// Genera una única instancia de la clase
	public static function getInstance(){
		
		if(self::$db == null){
			self::$db = new self();
		}

		return self::$db;
	}

	/** 
	 * Crea una conexión a la base de datos
	 * sólo si no el cliente no tenía una ya abierta.
	 */

  public function getDb(){
        if (self::$pdo == null) {
        	
        	/**
        	 * Nombre de la base de datos
        	 * Nombre del host
        	 * Nombre del usuario
        	 * Contraseña
        	 */

            self::$pdo = new PDO(
                "mysql:dbname=u399778566_jjesc" .
                ";host=mysql.hostinger.es;",
                "u399778566_jjesc",
                "123456789",
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
            );
            // Habilitar excepciones
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$pdo;
    }

	//Redefino esta función de clase para evitar clonaciones del objeto
	final protected function __clone(){}

	//Destructor del objeto pdo
	function _destructor(){
		self::$pdo = null;
	}
}

?>