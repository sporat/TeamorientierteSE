<?php
require_once("VerwaltungInfo.class.php");
require_once("DBStatement.class.php");
require_once("DBConnection.class.php");

class VerwaltungListe {
	
	private $admin;
	
	public function __construct() {
		$this->admin = array();
		
		$statement = new DBStatement(DBConnection::getInstance());
                
		$statement->executeQuery("SELECT BenutzerID FROM benutzer where Rolle = 'Verwaltung' order by BenutzerID ASC;");
		while ($row = $statement->getNextRow()) {
			$admin = new VerwaltungInfo();
			$admin->laden($row["BenutzerID"]);
			
			// Mit array_push werden neue Werte am Ende des Arrays angefügt 
			array_push($this->admin, $admin);
		}
	}

	public function getAdmin() {
		// korrekter Weise müsste hier das Array noch kopiert werden
		return $this->admin;
	}
	
}