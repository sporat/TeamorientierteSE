<?php

/*
Klasse wird benötigt, um die Liste in der Klasse 'ElternUeberblick.class.php' mit den entsprechenden Werten zu befüllen
 * Sind nur getter und setter
  */
class ElternEigenschaften {

	// Eigenschaften der Klasse
	protected $benutzerid;	
	protected $benutzername;
	protected $passwort;
	protected $vorname;
        protected $name;
	protected $email;
	protected $telefon;
	protected $rolleid;
        protected $rolle;
        protected $status;
        protected $mitteilungsweg;

	// Konstruktor
	public function __construct($benutzerid, $benutzername, $passwort, $vorname, $name, $email, $telefon, $rolle, $status, $mitteilungsweg) {
		$this->benutzerid = $benutzerid;
		$this->benutzername = $benutzername;
		$this->passwort = $passwort;
		$this->vorname = $vorname;
                $this->name = $name;
		$this->email = $email;
		$this->telefon = $telefon;
		$this->rolle = $rolle;
                $this->status = $status;
                $this->mitteilungsweg = $mitteilungsweg;               
	}

	public function setBenutzerID($benutzerid) {
		$this->benutzerid = $benutzerid;
	} 
	
	public function getBenutzerID() {
		return $this->benutzerid;	
	}
	
	public function setBenutzername($benutzername) {
		$this->benutzername = $benutzername;
	} 
	
	public function getBenutzername() {
		return $this->benutzername;	
	}
	
	public function setPasswort($passwort) {
		$this->passwort = $passwort;
	} 
	
	public function getPasswort() {
		return $this->passwort;	
	}
	
	public function setVorname($vorname) {
		$this->vorname = $vorname;
	} 
	
	public function getVorname() {
		return $this->vorname;	
	}
	
	public function setEmail($email) {
		$this->email = $email;
	} 
	
	public function getEmail() {
		return $this->email;	
	}

	public function setRolleID($rolle) {
		$this->rolle = $rolle;
	} 
	
	public function getRolle() {
		$this->rolle;

		if($this->rolle == 1) {
			$this->rolle = "Administrator";
		}
		if($this->rolle == 2) {
			$this->rolle = "Arbeitsvorbereiter";
		}
		if($this->rolle == 3) {
			$this->rolle = "Werker";
		}	
		return $this->rolle;
	}
	
	public function setTelefon($telefon) {
		$this->telefon = $telefon;
	} 
	
	public function getTelefon() {
		return $this->telefon;	
	}
        
	public function setName($name) {
		$this->name = $name;
	} 
	
	public function getName() {
		return $this->name;	
	}
        
        public function setStatus($status) {
		$this->status = $status;
	} 
	
	public function getStatus() {
		return $this->status;	
	}
        
        public function setMitteilungsweg($mitteilungsweg) {
		$this->mitteilungsweg = $mitteilungsweg;
	} 
	
	public function getMitteilungsweg() {
		return $this->mitteilungsweg;	
	}
	
        
	// Textuelle Repräsentation eines Objektes dieser Klasse
	public function __toString() {
		return $this->Name . " (Benutzer.: " . $this->benutzername . ")";
	}	
}
?>
