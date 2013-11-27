<?php
require_once("KlasseOhneLeiterInfo.class.php");
require_once("DBStatement.class.php");
require_once("DBConnection.class.php");

class KlassenOhneLeiterListe {

	private $klasse;
	
	public function __construct() {
		$this->klasse = array();
		
		$statement = new DBStatement(DBConnection::getInstance());
                
		$statement->executeQuery("SELECT klasse.* FROM klasse
                                            left join klassenlehrer on klasse.klasseid = klassenlehrer.klasseid
                                          where klassenlehrer.klasseid is null;");
		while ($row = $statement->getNextRow()) {
			$klasse = new KlasseOhneLeiterInfo();
			$klasse->laden($row["KlasseID"]);
			
			// Mit array_push werden neue Werte am Ende des Arrays angefügt 
			array_push($this->klasse, $klasse);
		}
	}

	public function getKlasse() {
		// korrekter Weise müsste hier das Array noch kopiert werden
		return $this->klasse;
	}
	
}
