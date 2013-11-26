<?php
require_once("LehrerInfo.class.php");
require_once("DBStatement.class.php");
require_once("DBConnection.class.php");


class LehrerListe {
	
	private $lehrer;
	
	public function __construct() {
		$this->lehrer = array();
		
		$statement = new DBStatement(DBConnection::getInstance());
		$statement->executeQuery("select benutzer.*,lehrer.sprechstunde_tag, lehrer.Sprechstunde_Uhrzeit, Lehrer.Raum, Lehrer.Funktion, lehrer.klassenlehrer  from lehrer left join Benutzer on lehrer.benutzerid = benutzer.benutzerID order by BenutzerID desc");

		while ($row = $statement->getNextRow()) {
			$lehrer = new LehrerInfo();
			$lehrer->laden($row["BenutzerID"]);
			                       
                       
			// Mit array_push werden neue Werte am Ende des Arrays angefügt 
			array_push($this->lehrer, $lehrer); 
                        
		}
	}

	public function getLehrer() {
		// korrekter Weise müsste hier das Array noch kopiert werden
		return $this->lehrer;
	}
	
}