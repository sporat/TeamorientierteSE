<?php
require_once("ElternDokumentEigenschaften.class.php");
require_once("DBStatement.class.php");
require_once("DBConnection.class.php");

class ElternDokumentListe {

	private $elterndok;
	
	public function __construct() {
		$this->elterndok = array();
		
		$statement = new DBStatement(DBConnection::getInstance());
                        
     if (User::getInstance()->getBenutzerId())
 {
   $benutzerid=  User::getInstance()->getBenutzerId(); 
 }
 else
 {
     $benutzerid=1;
 }
 $query = "SELECT dokument.dokumentid as dokumentid, dokument.dateiname, dokument.benutzerid, fach.fachid, fach.Bezeichnung, klasse.klasseid, klasse.kuerzel, klasse.jahrgangsstufe, Kind.Vorname, Kind.kindid as kindid, kind.benutzerid  FROM dokument, fach, dokumentklasse, klasse, Kind 
where dokument.fachid = fach.fachid
and dokument.dokumentid = dokumentklasse.dokumentid
and dokumentklasse.klasseid = klasse.klasseid
and klasse.klasseid = kind.klasseid
and Kind.benutzerid = ".$benutzerid."
         order by Kind.Vorname, fach.bezeichnung";

 $statement->executeQuery($query);
 	
 		while ($row = $statement->getNextRow()) {
			$elternfeature = new ElternDokumentEigenschaften();
			$elternfeature->laden($row["dokumentid"], $row["kindid"]);
			                        
			// Mit array_push werden neue Werte am Ende des Arrays angefügt 
			array_push($this->elterndok, $elternfeature);
		}
	}

	public function getElternDokument() {
            //Übergabe -Funktion an ElternDokumentUeberblick
		// korrekter Weise müsste hier das Array noch kopiert werden
		return $this->elterndok;
                
	}
	
}
