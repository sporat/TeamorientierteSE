<?php
require_once("Dokument.class.php");
require_once("DBStatement.class.php");
require_once("DBConnection.class.php");

class DokumentListe {

	private $dokument;
	
	public function __construct() {
		$this->dokument = array();
		
		$statement = new DBStatement(DBConnection::getInstance());
                         if(User::getInstance()->getRole()=="Verwaltung")
            {
		$statement->executeQuery("SELECT * FROM dokument");
            }
 else 
 {
     if (User::getInstance()->getBenutzerId())
 {
   $benutzerid=  User::getInstance()->getBenutzerId(); 
 }
 else
 {
     $benutzerid=1;
 }
 $statement->executeQuery("SELECT * FROM dokument where BenutzerID = ".$benutzerid.";");
 }	
 //Für die Eltern gibt es eine extra-Funktion, da diese nur die Dokumente ihres ausgewählten kindes herunterladen können, aufgeteilt nach Fach.
		while ($row = $statement->getNextRow()) {
			$dokument = new Dokument();
			$dokument->laden($row["DokumentID"]);
			
			// Mit array_push werden neue Werte am Ende des Arrays angefügt 
			array_push($this->dokument, $dokument);
		}
	}

	public function getDokument() {
		// korrekter Weise müsste hier das Array noch kopiert werden
		return $this->dokument;
                
	}
	
}
