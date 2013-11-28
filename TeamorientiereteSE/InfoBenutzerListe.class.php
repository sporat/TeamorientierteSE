<?php
require_once("Info.class.php");
require_once("DBStatement.class.php");
require_once("DBConnection.class.php");

class InfoBenutzerListe {

	private $info;
	
	public function __construct() {
		$this->info = array();
		
		$statement = new DBStatement(DBConnection::getInstance());
                $benutzerid = User::getInstance()->getBenutzerId();
           $query = "Select * from Information where benutzerid= $benutzerid";
        		$statement->executeQuery($query);
		while ($row = $statement->getNextRow()) {
			$info = new InfoSQL();
                        $infoid = $row["InfoID"];
                        $info->laden($infoid);
			
			// Mit array_push werden neue Werte am Ende des Arrays angefügt 
			array_push($this->info, $info);
		}
	}

	public function getInfo() {
		// korrekter Weise müsste hier das Array noch kopiert werden
		return $this->info;
                
	}
	
}




