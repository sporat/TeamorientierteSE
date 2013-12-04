<?php
require_once("ElternDokumentEigenschaften.class.php");
require_once("DBStatement.class.php");
require_once("DBConnection.class.php");

class AllgemeineDokumentListe {

	private $allgemeindok;
        private $dokmitfach;
        private $dokmitklasse;
	
	public function __construct() {
		$this->allgemeindok = array();
		$this->dokohnefach = array();
                $this->dokohneklasse = array();
		$statement = new DBStatement(DBConnection::getInstance());
                        
     if (User::getInstance()->getBenutzerId())
 {
   $benutzerid=  User::getInstance()->getBenutzerId(); 
 }
 else
 {
     $benutzerid=1;
 }
 $query = "SELECT distinct dokument.dokumentid as dokumentid, dokument.dateiname, dokument.benutzerid  
     FROM dokument, dokumentklasse
where dokument.fachid is null
and dokumentklasse.klasseid is null
         order by dokument.dateiname";
 
//wenn ein Dokument weder einer klasse, noch einem fach zugeordnet ist, d.h. ein allgemeines dokument ist
 $statement->executeQuery($query);
 	
 		while ($row = $statement->getNextRow()) {
			$elterndokfeature = new ElternDokumentEigenschaften();
			$elterndokfeature->ohneFachOhneKlasseladen($row["dokumentid"]);
			                        
			// Mit array_push werden neue Werte am Ende des Arrays angefügt 
			array_push($this->allgemeindok, $elterndokfeature);
		}
 
$query1 = "SELECT distinct dokument.dokumentid as dokumentid, dokument.dateiname, dokument.benutzerid, dokumentklasse.klasseid, kind.vorname  
     FROM dokument, dokumentklasse, kind, klasse
where dokument.fachid is null
and dokument.dokumentid = dokumentklasse.dokumentid
and dokumentklasse.klasseid= kind.klasseid
and kind.benutzerid = ".$benutzerid."
         order by kind.vorname, dokument.dateiname";

  // wenn ein dokument zwar einer klasse aber keinem fach zugeordnet ist
 $statement->executeQuery($query1);
 	
 		while ($row = $statement->getNextRow()) {
			$elterndokfeature = new ElternDokumentEigenschaften();
			$elterndokfeature->ohneFachladen($row["dokumentid"]);
			                        
			// Mit array_push werden neue Werte am Ende des Arrays angefügt 
			array_push($this->dokohnefach, $elterndokfeature);
		}               
 $query2 = "SELECT distinct dokument.dokumentid as dokumentid, dokument.dateiname, dokument.benutzerid, dokumentklasse.klasseid 
     FROM dokument, dokumentklasse, fach
where dokumentklasse.klasseid is null
and dokument.fachid = fach.fachid
         order by dokument.dateiname";
    
// wenn ein dokument zwar einer klasse aber keinem fach zugeordnet ist
 $statement->executeQuery($query2);
 	
 		while ($row = $statement->getNextRow()) {
			$elterndokfeature = new ElternDokumentEigenschaften();
			$elterndokfeature->ohneKlasseladen($row["dokumentid"]);
			                        
			// Mit array_push werden neue Werte am Ende des Arrays angefügt 
			array_push($this->dokohneklasse, $elterndokfeature);
		}  
	}

	public function getAllgemeinesDokument() {
            //Übergabe -Funktion an ElternDokumentUeberblick
		// korrekter Weise müsste hier das Array noch kopiert werden
		return $this->allgemeindok;
                
	}
	public function getDokumentOhneFach() {
            //Übergabe -Funktion an ElternDokumentUeberblick
		// korrekter Weise müsste hier das Array noch kopiert werden
		return $this->dokohnefach;
                
	}
        public function getDokumentOhneKlasse() {
            //Übergabe -Funktion an ElternDokumentUeberblick
		// korrekter Weise müsste hier das Array noch kopiert werden
		return $this->dokohneklasse;
                
	}
}
