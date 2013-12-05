<?php
require_once("Info.class.php");

require_once("DBStatement.class.php");
require_once("DBConnection.class.php");

class InfoBenutzerListe {

	private $info;
	
	public function __construct() {
		$this->info = array();
		
		$statement = new DBStatement(DBConnection::getInstance());
                if(User::getInstance()->getBenutzerId()){
                $benutzerid= User::getInstance()->getBenutzerId();}
                else{
                    $benutzerid=1;
                    
                }
		$statement->executeQuery("Select * from Information where benutzerid= ".$benutzerid."");
		while ($row = $statement->getNextRow()) {
			$infosql = new InfoSQL();
			$infosql->laden($row["InfoID"]);
			
			// Mit array_push werden neue Werte am Ende des Arrays angefügt 
			array_push($this->info, $infosql);
		}
	}

	public function getInfo() {
		// korrekter Weise müsste hier das Array noch kopiert werden
		return $this->info;
                
	}
	
}




