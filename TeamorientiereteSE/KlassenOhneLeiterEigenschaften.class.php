<?php
class KlasseOhneLeiterEigenschaften {

	// Eigenschaften der Klasse
	protected $klasseid;	
	protected $jahrgangsstufe;
	protected $kuerzel;
	

	// Konstruktor
	public function __construct($klasseid, $jahrgangsstufe, $kuerzel) {
		$this->benutzerid = $klasseid;
		$this->benutzername = $jahrgangsstufe;
		$this->kuerzel = $kuerzel;               
	}

	public function setKlasseID($klasseid) {
		$this->klasseid = $klasseid;
	} 
	
	public function getKlasseID() {
		return $this->klasseid;	
	}
	
	public function setJahrgangsstufe($jahrgangsstufe) {
		$this->jahrgangsstufe = $jahrgangsstufe;
	} 
	
	public function getJahrgangsstufe() {
		return $this->jahrgangsstufe;	
	}
	
	public function setKuerzel($kuerzel) {
		$this->kuerzel = $kuerzel;
	} 
	
	public function getKuerzel() {
		return $this->kuerzel;	
	}
	
	
		
	// Textuelle Repräsentation eines Objektes dieser Klasse
	public function __toString() {
		return $thisjahrgangsstufeName . " (Jahrgangsstufe.: " . $this->jahrgangsstufe . ")";
	}	
}
?>
