<?php
  	class Database{

  		// Define informações necessarias para uso do banco de dados.
	    private static $dbName = 'KTrello';
	    private static $dbHost = 'localhost';
	    private static $dbUsername = 'root';
	    private static $dbUserPassword = '';
	     
	    private static $conn  = null;

	    // Função de conexão.
	    public static function connect() {
	      
	      	// Se a variável de conexão for nula, inicia o processo de conexão.
			if(null == self::$conn) {     
		        try {
		      		self::$conn =  new PDO("mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword); 
		        }
		        catch(PDOException $e) { // Controle de erros.
		      		die($e->getMessage()); 
		        }
	      	}
	      	return self::$conn;
	    }
	    
	    // Função de desconexão. 
	    public static function disconnect() {
	      	self::$conn = null; //Torna a conexão nula.
	    }

	    public static function timeset() {
	    	date_default_timezone_set('America/Sao_Paulo'); // Definição de fuso horário.
	    }
  	}
?>