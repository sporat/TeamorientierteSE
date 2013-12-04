<?php
class KlassenlehrerEigenschaften {

	// Eigenschaften der Klasse
	protected $benutzerid;	
	protected $benutzername;
	protected $passwort;
        protected $name;
	protected $vorname;
        protected $email;
        protected $rolle;
	protected $telefon;
	protected $status;
        

	// Konstruktor
	public function __construct($benutzerid, $benutzername, $passwort, $vorname, $name, $email, $telefon, $rolle) {
		$this->benutzerid = $benutzerid;
		$this->benutzername = $benutzername;
		$this->passwort = $passwort;
		$this->vorname = $vorname;
                $this->name = $name;
		$this->email = $email;
		$this->telefon = $telefon;
		$this->rolle = $rolle;
                
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

	public function setRolleID($rolleid) {
		$this->rolleid = $rolleid;
	} 
	
	public function getRolle() {
		$this->rolleid;

		if($this->rolleid == 1) {
			$this->rolle = "Administrator";
		}
		if($this->rolleid == 2) {
			$this->rolle = "Arbeitsvorbereiter";
		}
		if($this->rolleid == 3) {
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


	public function setRaum($raum) {
		$this->raum = $raum;
	} 
	
	public function getRaum() {
		return $this->raum;	
	}
		
	// Textuelle Repräsentation eines Objektes dieser Klasse
	public function __toString() {
		return $this->Name . " (Benutzer.: " . $this->benutzername . ")";
	}	
}
?>
