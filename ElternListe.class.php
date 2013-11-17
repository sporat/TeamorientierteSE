<?php
require_once("ElternInfo.class.php");
require_once("DBStatement.class.php");
require_once("DBConnection.class.php");


class ElternListe {
	
	private $eltern;
	
	public function __construct() {
		$this->eltern = array();
		
		$statement = new DBStatement(DBConnection::getInstance());
		$statement->executeQuery("SELECT * 
                                          FROM Benutzer
                                          LEFT JOIN Eltern ON Benutzer.BenutzerID = Eltern.BenutzerID
                                          WHERE rolle =  'Eltern'");

		while ($row = $statement->getNextRow()) {
			$eltern = new ElternInfo();
			$eltern->laden($row["BenutzerID"]);
			                       
                       
			// Mit array_push werden neue Werte am Ende des Arrays angefügt 
			array_push($this->eltern, $eltern); 
                        
		}
	}

	public function getEltern() {
		// korrekter Weise müsste hier das Array noch kopiert werden
		return $this->eltern;
	}
	
}