<?php
require_once("VerwaltungInfo.class.php");
require_once("DBStatement.class.php");
require_once("DBConnection.class.php");

class KlassenlehrerListe {

	private $klassenlehrer;
	
	public function __construct() {
		$this->klassenlehrer = array();
		
		$statement = new DBStatement(DBConnection::getInstance());
                
		$statement->executeQuery("select benutzer.* from benutzer 
                                          left join klassenlehrer on benutzer.benutzerid = klassenlehrer.benutzerid
                                          where rolle = 'Klassenlehrer' and klasseid is null");
		while ($row = $statement->getNextRow()) {
			$klassenlehrer = new VerwaltungInfo();
			$klassenlehrer->laden($row["BenutzerID"]);
			
			// Mit array_push werden neue Werte am Ende des Arrays angefügt 
			array_push($this->klassenlehrer, $klassenlehrer);
		}
	}

	public function getKlassenlehrer() {
		// korrekter Weise müsste hier das Array noch kopiert werden
		return $this->klassenlehrer;
	}
	
}
