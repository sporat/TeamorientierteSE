<?php
require_once("Info.class.php");

require_once("DBStatement.class.php");
require_once("DBConnection.class.php");

class InfoBenutzerListe {

	private $info;
	
	public function __construct() {
		$this->info = array();
		
		$statement = new DBStatement(DBConnection::getInstance());
                
		$statement->executeQuery("Select * from Information where benutzerid=User::getInstance()->getBenutzerId()");
		while ($row = $statement->getNextRow()) {
			$info = new Info();
			$info->laden($row["infoid"]);
			
			// Mit array_push werden neue Werte am Ende des Arrays angefügt 
			array_push($this->info, $info);
		}
	}

	public function getInfo() {
		// korrekter Weise müsste hier das Array noch kopiert werden
		return $this->info;
                
	}
	
}




