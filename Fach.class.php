<?php
require_once ("DBStatement.class.php");
require_once ("DBConnection.class.php");
class Fach  {

	// Eigenschaften der Klasse
	protected $fachid;	
	protected $bezeichnung;
	

	// Konstruktor
	public function __construct($fachid = null, $bezeichnung= "") {
		$this->fachid = $fachid;
		$this->bezeichnung = $bezeichnung;
		
                
	}
        public function laden($fachid) {
        $statement = new DBStatement(DBConnection::getInstance());

        $statement->executeQuery("SELECT * FROM fach WHERE FachID = $fachid;");
        if ($row = $statement->getNextRow()) {
            $this->fachid = $fachid;
            
            $this->bezeichnung = $row["Bezeichnung"];

            return true;
        }
		
        return false;
    }

	public function setFachID($Fachid) {
		$this->fachid = $fachid;
	} 
	
	public function getFachID() {
		return $this->fachid;	
	}
	
	public function setBezeichnung($bezeichnung) {
		$this->bezeichnung = $bezeichnung;
	} 
	
	public function getBezeichnung() {
		return $this->bezeichnung;	
	}
	
	
	// Textuelle Repräsentation eines Objektes dieser Klasse
	public function __toString() {
		return $this->bezeichnung;
	}	
}
?>
