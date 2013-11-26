<?php
require_once ("DBStatement.class.php");
require_once ("DBConnection.class.php");
class Schueler  {

	// Eigenschaften der Klasse
	protected $kindid;	
	protected $name;
	protected $vorname;
	protected $geburtsdatum;
        protected $strasse;
	protected $plz;
	protected $ort;
	protected $jahrgangsstufe;
	//protected $rolleid;
    //  protected $rolle;

	// Konstruktor
	public function __construct($kindid = null, $name= "", $vorname= "", $geburtsdatum="", $strasse="", $plz="", $ort="", $jahrgangsstufe= null) {
		$this->kindid = $kindid;
		$this->name = $name;
		$this->vorname = $vorname;
		$this->geburtsdatum = $geburtsdatum;
		$this->strasse = $strasse;
		$this->plz = $plz;
		$this->ort = $ort;
		$this->jahrgangsstufe = $jahrgangsstufe;
		//$this->rolleid = $rolleid;
                
	}
        public function laden($kindid) {
        $statement = new DBStatement(DBConnection::getInstance());

        $statement->executeQuery("SELECT * FROM kind WHERE KindID = $kindid;");
        if ($row = $statement->getNextRow()) {
            $this->kindid = $kindid;
            
            $this->vorname = $row["Vorname"];
            $this->name = $row["Name"];
            $this->geburtsdatum = $row["Geburtsdatum"];
            $this->strasse = $row["Strasse"];
            $this->plz = $row["PLZ"];
            $this->ort= $row["Ort"];
            $this->jahrgangsstufe = $row["Jahrgangsstufe"];

            return true;
        }
        return false;
    }

	public function setKindID($kindid) {
		$this->kindid = $kindid;
	} 
	
	public function getKindID() {
		return $this->kindid;	
	}
	
	public function setName($name) {
		$this->name = $name;
	} 
	
	public function getName() {
		return $this->name;	
	}
	
	public function setVorname($vorname) {
		$this->vorname = $vorname;
	} 
	
	public function getVorname() {
		return $this->vorname;	
	}
	
	public function setGeburtsdatum($geburtsdatum) {
		$this->geburtsdatum = $geburtsdatum;
	} 
	
	public function getGeburtsdatum() {
		return $this->geburtsdatum;	
	}
	
	public function setStrasse($strasse) {
		$this->strasse = $strasse;
	} 
	
	public function getStrasse() {
		return $this->strasse;	
	}

	public function setPLZ($plz) {
		$this->plz = $plz;
	} 
	
	public function getPLZ() {
		return $this->plz;
	}
	
	public function setOrt($ort) {
		$this->ort = $ort;
	} 
	
	public function getOrt() {
		return $this->ort;	
	}
        
	public function setJahrgangsstufe($jahrgangsstufe) {
		$this->jahrgangsstufe = $jahrgangsstufe;
	} 
	
	public function getJahrgangsstufe() {
		return $this->jahrgangsstufe;	
	}
		
	// Textuelle Repräsentation eines Objektes dieser Klasse
	public function __toString() {
		return $this->name;
	}	
}
?>
