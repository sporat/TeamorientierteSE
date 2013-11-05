<?php

require_once("DBConnection.class.php");
require_once("DBStatement.class.php");

class User {
	
	private $loggedIn;
	private $role_id;
	private $role;
	private $user;
	private $password;	
	

	// TODO hier m�ssen alle Attribute, die ein Benutzer ben�tigt, erg�nzt werden

	private static $instance; // Singleton-Instanz der Klasse

	/**
	 * Gibt das Singleton-Objekt zur�ck
	 *
	 * @return User-Singleton-Objekt
	 */
	public static function getInstance() {

		// Pr�fen, ob bereits eine Instanz angelegt vorhanden ist
		if (!isset(self::$instance)) {
			// Anlegen einer Singleton-Instanz
			self::$instance = new User();
		}

		return self::$instance;

	}

	/**
	 * Setzt das Singleton-Objekt
	 *
	 * Wird vorwiegend nach dem Auslesen eines User-Objektes aus der Session ben�tigt
	 *
	 * @param User $user Setzt das als Singleton-Objekt zu setzende User-Objekt
	 */
	public static function setAsInstance(User $user) {
		self::$instance = $user;
	}

	public function __construct() {
		$this->loggedIn=false;
	}

	/**
	 * Meldet einen Benutzer an
	 *
	 * @return true, wenn die Anmeldung erfolgreich war, sonst false
	 */
	public function login($login, $pass) {
		
		$connect = new DBConnection();
		$statement = new DBStatement($connect);
                mysql_select_db('testdatenbank');
		$query = "select * from user where username = '".$login."' and passwort = '".$pass."'";
                
		$statement->executeQuery($query);
		if($row = $statement->getNextRow()) {
			$this->loggedIn = true;
		}
		else {
			$this->loggedIn = false;
		}
		return $this->loggedIn;
		
	}

	public function logout() {
		$this->loggedIn = false;
		$this->role_id = "";
		$this->role = "";
		$this->login = "";
		
		return $this->loggedIn;
	}

	public function isLoggedIn() {
		return $this->loggedIn;
	}

	/**
	 * L�d den Benutzer
	 *
	 * @return true, wenn der Benutzer geladen werden konnte, sonst false
	 */
	public function load($login, $pass) {
		$connect = new DBConnection();
		$statement = new DBStatement($connect);
		
		$query = "select * from user where username = '".$login."' and passwort = '".$pass."'";
		$statement->executeQuery($query);
			if($row = $statement->getNextRow()) {
				$this->id = $row['mitarbeiter_id'];
				$this->user = $row['benutzername'];
				$this->password = $row['passwort'];
				//$this->role_id = $row['rolle_id'];		
				return true;
			} else 
			session_unset();
			return false;
	}

	// TODO hier m�ssen die Getter und Setter der Attribute ersetzt werden
	public function getRole() {
		/*if($this->role_id == 1) {
			$this->role = "Administrator";
		}
		if($this->role_id == 2) {
			$this->role = "Arbeitsvorbereiter";
		}
		if($this->role_id == 3) {
			$this->role = "Werker";
		}	*/
                $this->role = "Werker";
		return $this->role; 
	}
	
	public function getuser() {
		return $this->user;
	}
        
        public function test1() {
		echo "test";
	}
    }
?>