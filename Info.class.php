<?php
require_once ("DBStatement.class.php");
require_once ("DBConnection.class.php");
class Info  {

	// Eigenschaften der Klasse
	protected $infoid;	
	protected $bezeichnung;
	protected $textfeld;
	protected $gültigkeitsdatum;
    protected $benutzerID;
	

	// Konstruktor
	public function __construct($infoid = null, $bezeichnung= "", $textfeld= "", $gültigkeitsdatum="", $benutzerID=null) {
		$this->infoid = $infoid;
		$this->bezeichnung = $bezeichnung;
		$this->textfeld = $textfeld;
		$this->gültigkeitsdatum = $gültigkeitsdatum;
		$this->benutzerID = $benutzerID;
		
                
	}

	public function setInfoID($infoid) {
		$this->infoid = $infoid;
	} 
	
	public function getInfoID() {
		return $this->infoid;	
	}
	
	public function setBezeichnung($bezeichnung) {
		$this->bezeichnung = $bezeichnung;
	} 
	
	public function getBezeichnung() {
		return $this->bezeichnung;	
	}
	
	public function setText($textfeld) {
		$this->textfeld = $textfeld;
	} 
	
	public function getText() {
		return $this->textfeld;	
	}
	
	public function setGültigkeitsdatum($gültigkeitsdatum) {
		$this->gültigkeitsdatum = $gültigkeitsdatum;
	} 
	
	public function getGültigkeitsdatum() {
		return $this->gültigkeitsdatum;	
	}
	
	public function setBenutzerID($benutzerID) {
		$this->benutzerID = $benutzerID;
	} 
	
	public function getBenutzerID() {
		return $this->benutzerID;	
	}

	
		
	// Textuelle Repräsentation eines Objektes dieser Klasse
	public function __toString() {
		return $this->bezeichnung;
	}	
}
?>
