<?php

    define('mysqlhost', 'localhost'); 
    define('mysqluser', 'root'); 
    define('mysqlpassword', ''); 
    define('mysqldatabase', 'eule');

class DBConnection {
	private $connection;
	private static $instance;

	/**
	 * Singleton Zugriff
	 *
	 * @return Singleton-Instanz
	 */
	public static function getInstance() {

		if (!isset(self::$instance)) {
			self::$instance = new DBConnection();
		}

		return self::$instance;

	}

	public function __construct() {

		//$connStr = "host =mysqlhost port =5432 dbname=webapp33 user=webapp33 password =6J5qZxW8H4";
		$this->connection = mysql_connect(mysqlhost, mysqluser, mysqlpassword);
		mysql_select_db('eule');	
	}

	public function __destruct()
	{if(is_resource($this->connection)) {
		mysql_close($this->connection);
	}
	}
	public function getConnection(){
			
		return $this->connection;
	}
}
?>