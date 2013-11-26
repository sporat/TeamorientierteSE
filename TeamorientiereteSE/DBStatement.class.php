<?php
class DBStatement{

	private $dbConn;
	private $result;
	private $anz;

	public function __construct(DBConnection $conn) {
		$this->dbConn=$conn;
	}

	public function __destruct() {
		if(is_resource($this->result)) {
			mysql_free_result($this->result);
		}
	}
        
        //TODO VERA
        //Funktion funktioniert soweit, es kommt nur immer eine Fehlermeldung, wenn mann Zeile 24 wieder einkommentiert.
        //Weiss auch nicht was das genau macht, ist eine Funktion von Eva
	public function executeQuery($queryStr){
		$res = $this->dbConn->getConnection();
		$ret = false;
		try{
			$this->result = mysql_query($queryStr) or die(mysql_error()); 
			//$this->anz =mysql_num_rows ($this->result   );
			$ret = true;
		}
		catch (Exception $e){
			print "Autsch";
		}

		return $ret;
	}
		


	public function getAll(){
		if(is_resource($this->result)) {
			return mysql_fetch_all($this->result);
		}
	}
	public function getNextRow() {
		if(is_resource($this->result)) {
			return mysql_fetch_array($this->result);
		}
	}
	public function getResult (){
		return $this->result;
	}
	public function getAnz() {
            return $this->anz;
        }
        
        
        //Muss noch angepasst werden
        /*public function getNewBenutzerID() {
            $query = "Select (case when MAX(BenutzerID) is null then 1 else MAX(BenutzerID)+1 end) as BenutzerID from Benutzer";
            $statement->executeQuery($query);
            $erg = pg_query($query);
            return pg_fetch_result($erg,0,0);
        }*/
		
}
?>

