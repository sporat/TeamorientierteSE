<?php
require_once("Klasse.class.php");

require_once("DBStatement.class.php");
require_once("DBConnection.class.php");

class KlassenListe {
        
	private $klasse;
	
	public function __construct() {
		$this->klasse = array();
		
		$statement = new DBStatement(DBConnection::getInstance());
                
		$statement->executeQuery("SELECT KlasseID FROM Klasse");
		while ($row = $statement->getNextRow()) {
                        $klassenclass = new Klasse();
			$klasseid=$row['KlasseID'];
                        $klassenclass->load($klasseid);
                       
			// Mit array_push werden neue Werte am Ende des Arrays angefügt 
			array_push($this->klasse, $klassenclass);
		}
	}

	public function getKlasse() {
		// korrekter Weise müsste hier das Array noch kopiert werden
		return $this->klasse;
                
	}
	
}
