<?php
require_once("LehrerInfo.class.php");
require_once("DBStatement.class.php");
require_once("DBConnection.class.php");



class Klassenlehrer_or_notListe {
	
	private $lehrer;
	private $query;
        private $contentId;
	public function __construct() {
            if(array_key_exists('contentId', $_REQUEST)){
              
                $this->contentId = $_REQUEST['contentId'];
            }
            else {
               
                $this->contentId="";
                }
		$this->lehrer = array();
                $lehrersql= new LehrerSQL();
       
		$statement = new DBStatement(DBConnection::getInstance());
                if($this->contentId =='klassenlehrermarkierung_loeschen')
                {
                $this->query = "Select * from Lehrer where Klassenlehrer =1";
                $statement->executeQuery($this->query);
                while ($row = $statement->getNextRow()) {
			$lehrer = new LehrerInfo();
			$lehrer->laden($row["BenutzerID"]);
			                       
                       
			// Mit array_push werden neue Werte am Ende des Arrays angefügt 
			array_push($this->lehrer, $lehrer); 
                        
                        
		}
                
                }
                elseif($this->contentId =='lehrer_zu_klassenlehrer')
                {
                    $this->query = "Select * from Lehrer where Klassenlehrer = 0";
                    $statement->executeQuery($this->query);
                while ($row = $statement->getNextRow()) {
			$lehrer = new LehrerInfo();
			$lehrer->laden($row["BenutzerID"]);
			                       
                       
			// Mit array_push werden neue Werte am Ende des Arrays angefügt 
                       
                array_push($this->lehrer, $lehrer); 
               
                
                }
                }
		
	}

	public function getLehrer() {
		// korrekter Weise müsste hier das Array noch kopiert werden
		return $this->lehrer;
	}
	
}