<?php
require_once("Schueler.class.php");

require_once("DBStatement.class.php");
require_once("DBConnection.class.php");

class SchuelerDesKlassenlehrersListe {

	private $schueler;
        private $jahrgangsstufe;
        
        
	public function __construct($klasseid) {
		$this->schueler = array();
		
		$statement = new DBStatement(DBConnection::getInstance());
                
		$statement->executeQuery("SELECT KindID FROM kind WHERE KlasseID = '$klasseid' order by KindID ASC;");
		while ($row = $statement->getNextRow()) {
			$schueler = new Schueler();
			$schueler->laden($row["KindID"]);
			
			// Mit array_push werden neue Werte am Ende des Arrays angefügt 
			array_push($this->schueler, $schueler);
		}
	}

	public function getSchueler() {
		// korrekter Weise müsste hier das Array noch kopiert werden
		return $this->schueler;
                
	}
	
}
