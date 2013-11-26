<?php

require_once("DBConnection.class.php");
require_once("FachSQL.class.php");

class FachSQL {
    public function exists($bezeichnung){
        $statement = new DBStatement(DBConnection::getInstance());
        $query3="select * from fach where bezeichnung = '".$bezeichnung."'";
         $statement->executeQuery($query3);
          if ($row = $statement->getNextRow()) {
            return true;
        } else {
            return false;
        }
        
    }

    public function anlegen($bezeichnung) {
        $statement = new DBStatement(DBConnection::getInstance());
        if (!$this->exists($bezeichnung)) 
		{
        $query = "insert into fach (`Bezeichnung`) values ('".$bezeichnung."')";
       
        $statement->executeQuery($query);
		return true;
		}
		return false;
    }

    public function speichern($fachid, $bezeichnung) {

        $statement = new DBStatement(DBConnection::getInstance());
		if (!$this->exists($bezeichnung))
		{
        $sql = "UPDATE "
                . "fach "
                . "SET "
                . "Bezeichnung= '$bezeichnung'"
                . " WHERE FachID = " .$fachid. "";
        //print $sql;
		$statement->executeQuery($sql);
		return true;
}
      
		return false;
    }

    

}
