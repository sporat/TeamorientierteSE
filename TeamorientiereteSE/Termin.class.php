<?php
require_once ("DBStatement.class.php");
require_once ("DBConnection.class.php");
class Termin  {

	// Eigenschaften der Klasse
	protected $terminid;	
	protected $beschreibung;
    protected $ort;
    protected $infoschreiben;
    protected $verantwortlicher;
    protected $benutzernummer;
    protected $datum;
    protected $zeit;
	

	// Konstruktor
	public function __construct($terminid = null, $beschreibung= "", $ort= "", $infoschreiben="", $verantwortlicher="", $benutzernummer=null, $datum="", $zeit= "") {
		$this->terminid = $terminid;
		$this->beschreibung = $beschreibung;
		$this->ort = $ort;
		$this->infoschreiben = $infoschreiben;
		$this->verantwortlicher = $verantwortlicher;
		$this->datum = $datum;
		$this->benutzernummer = $benutzernummer;
		$this->zeit = $zeit;
		                
	}
        public function laden($terminid) {
        $statement = new DBStatement(DBConnection::getInstance());

        $statement->executeQuery("SELECT * FROM termin WHERE terminid = $terminid;");
        if ($row = $statement->getNextRow()) {
            $this->terminid = $terminid;
            $this->beschreibung = $row["Beschreibung"];
		$this->ort = $row["Ort"];
		$this->infoschreiben = $row["Infoschreiben"];
		$this->verantwortlicher = $row["Verantwortlicher"];
		$this->datum = $row["Datum"];
		$this->benutzernummer = $row["BenutzerID"];
		$this->zeit = $row["Uhrzeit"];

            return true;
        }
        return false;
    }

	public function getTerminID() {
		return $this->terminid;	
	}
	
	
	
	public function getBeschreibung() {
		return $this->beschreibung;	
	}
	
	
	public function getVerantwortlicher() {
		return $this->verantwortlicher;	
	}
	
	
	
	public function getInfoschreiben() {
		return $this->infoschreiben;	
	}
	
	public function getOrt() {
		return $this->ort;	
	}

	public function getDatum() {
		return $this->datum;
	}
	
	public function getZeit() {
		return $this->zeit;	
	}
        
	public function getBenutzernummer() {
		return $this->benutzernummer;	
	}
		
	// Textuelle Repräsentation eines Objektes dieser Klasse
	public function __toString() {
		return $this->beschreibung;
	}	
}
?>


