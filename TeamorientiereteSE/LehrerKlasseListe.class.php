<?php
require_once("Klasse.class.php");
require_once("DBStatement.class.php");
require_once("DBConnection.class.php");

class LehrerKlasseListe {

	private $klasse;
	
	public function __construct() {
		$this->klasse = array();
		
		$statement = new DBStatement(DBConnection::getInstance());
    if (User::getInstance()->getBenutzerId())
 {
   $benutzerid=  User::getInstance()->getBenutzerId(); 
 }
 else
 {
     $benutzerid=1;
 }
	
 $statement->executeQuery("SELECT distinct klasse.klasseid as klassenid , klasse.jahrgangsstufe, klasse.kuerzel FROM lehrerfach, lehrerfachklasse, klasse "
                        . " where lehrerfach.benutzerid = ".$benutzerid." "
                        . " and lehrerfach.lfid = lehrerfachklasse.lfid and lehrerfachklasse.klasseid = klasse.klasseid "
         . " order by klasse.jahrgangsstufe, klasse.kuerzel;");
         
		while ($row = $statement->getNextRow()) {
			$klasse = new Klasse();
			$klasse->load($row["klassenid"]);
			
			// Mit array_push werden neue Werte am Ende des Arrays angefügt 
			array_push($this->klasse, $klasse);
		}
	}

	public function getKlasse() {
		// korrekter Weise müsste hier das Array noch kopiert werden
		return $this->klasse;
                
	}
	
}
