<?php
require_once("Termin.class.php");

require_once("DBStatement.class.php");
require_once("DBConnection.class.php");

class TerminListe {

	private $termin;
	
	public function __construct() {
		$this->termin = array();
		
		$statement = new DBStatement(DBConnection::getInstance());
                
		$statement->executeQuery("Select * from Termin where benutzerid=User::getInstance()->getBenutzerId()");
		while ($row = $statement->getNextRow()) {
			$termin = new Termin();
			$termin->laden($row["terminid"]);
			
			// Mit array_push werden neue Werte am Ende des Arrays angefügt 
			array_push($this->termin, $termin);
		}
	}

	public function getTermin() {
		// korrekter Weise müsste hier das Array noch kopiert werden
		return $this->termin;
                
	}
	
}


