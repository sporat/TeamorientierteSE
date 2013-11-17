<?php

require_once("DBConnection.class.php");
require_once("DBStatement.class.php");


class User {
	
	private $loggedIn;
        private $benutzerid;
        private $benutzername;
        private $passwort;
        private $name;
        private $vorname;
        private $email;
        private $telefon;
	private $rolle;	

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
            
		$statement = new DBStatement(DBConnection::getInstance());
                
		$query = "select * from benutzer where benutzername = '".$login."' and passwort = '".$pass."'";
                   
		if($statement->executeQuery($query)) {
                    $this->loggedIn = true;
                }else {
                    $this->loggedIn = false;
                }
		/*if($row = $statement->getNextRow()) {
			$this->loggedIn = true;
		}
		else {
			$this->loggedIn = false;
		}*/
		return $this->loggedIn;
		
	}

	public function logout() {
		$this->loggedIn = false;
		$this->rolleid = "";
		$this->rolle = "";
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
		$statement = new DBStatement(DBConnection::getInstance());
		
		$query = "select * from benutzer where benutzername = '".$login."' and passwort = '".$pass."'";
		$statement->executeQuery($query);
			if($row = $statement->getNextRow()) {
				$this->benutzerid = $row['BenutzerID'];
                                $this->benutzername = $row['Benutzername'];
                                $this->passwort = $row['Passwort'];
				$this->name = $row['Name'];
				$this->vorname = $row['Vorname'];
                                $this->email = $row['Email'];
                                $this->telefon = $row['Telefon'];
				$this->rolle = $row['Rolle'];
				return true;
			} else 
			session_unset();
			return false;
	}

	// TODO hier m�ssen die Getter und Setter der Attribute ersetzt werden
	public function getRole() {
		if($this->rolle == "Systemadministrator") {
			$this->rolle = "Systemadministrator";
		}
		if($this->rolle == "Verwaltung") {
			$this->rolle = "Verwaltung";
		}
		if($this->rolle == "Eltern") {
			$this->rolle = "Eltern";
		}	
                if($this->rolle == "Lehrer") {
			$this->rolle = "Lehrer";
		}
                if($this->rolle == "Klassenlehrer") {
			$this->rolle = "Klassenlehrer";
		}
             
		return $this->rolle; 
	}
	
	public function getuser() {
		return $this->user;
	}
 
    }
?>