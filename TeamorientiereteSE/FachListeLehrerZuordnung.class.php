<?php
require_once("Fach.class.php");
require_once("DBStatement.class.php");
require_once("DBConnection.class.php");

class FachListeLehrerZuordnung {

	private $fach;
	
	public function __construct() {
		$this->fach = array();
		
		$statement = new DBStatement(DBConnection::getInstance());
                        
		$statement->executeQuery("SELECT FachID FROM fach order by FachID ASC;");
          
		
		while ($row = $statement->getNextRow()) {
			$fach = new Fach();
			$fach->laden($row["FachID"]);
			
			// Mit array_push werden neue Werte am Ende des Arrays angefügt 
			array_push($this->fach, $fach);
		}
	}

	public function getFach() {
		// korrekter Weise müsste hier das Array noch kopiert werden
		return $this->fach;
                
	}
	
}
