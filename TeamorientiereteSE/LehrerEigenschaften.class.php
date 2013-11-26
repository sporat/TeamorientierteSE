<?php
class LehrerEigenschaften {

	// Eigenschaften der Klasse
	protected $benutzerid;	
	protected $benutzername;
	protected $passwort;
	protected $vorname;
        protected $name;
	protected $email;
	protected $telefon;
	protected $raum;
	protected $rolleid;
        protected $rolle;
        protected $sprechstundeTag;
        protected $sprechstundeZeit;
        protected $funktion;
        protected $klassenlehrer;

	// Konstruktor
	public function __construct($benutzerid, $benutzername, $passwort, $vorname, $name, $email, $telefon, $raum, $rolle, $sprechstundeTag, $sprechstundeZeit, $funktion, $klassenlehrer) {
		$this->benutzerid = $benutzerid;
		$this->benutzername = $benutzername;
		$this->passwort = $passwort;
		$this->vorname = $vorname;
                $this->name = $name;
		$this->email = $email;
		$this->telefon = $telefon;
		$this->raum = $raum;
		$this->rolle = $rolle;
                $this->sprechstundeTag = $sprechstundeTag;
                $this->sprechstundeZeit = $sprechstundeZeit;
                $this->funktion = $funktion;
                $this->klassenlehrer = $klassenlehrer;
               
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


	public function setRaum($raum) {
		$this->raum = $raum;
	} 
	
	public function getRaum() {
		return $this->raum;	
	}
        
        public function setSprechstundeTag($sprechstundeTag) {
		$this->sprechstundeTag = $sprechstundeTag;
	} 
	
	public function getSprechstundeTag() {
		return $this->sprechstundeTag;	
	}
        
        public function setSprechstundeZeit($sprechstundeZeit) {
		$this->sprechstundeZeit = $sprechstundeZeit;
	} 
	
	public function getSprechstundeZeit() {
		return $this->sprechstundeZeit;	
	}
	
        public function setFunktion($funktion) {
		$this->funktion = $funktion;
	} 
	
	public function getFunktion() {
		return $this->funktion;	
	}
        
        public function setKlassenlehrer($klassenlehrer) {
		$this->klassenlehrer = $klassenlehrer;
	} 
	
	public function getKlassenlehrer() {
		return $this->klassenlehrer;	
	}
	// Textuelle Repräsentation eines Objektes dieser Klasse
	public function __toString() {
		return $this->Name . " (Benutzer.: " . $this->benutzername . ")";
	}	
}
?>
