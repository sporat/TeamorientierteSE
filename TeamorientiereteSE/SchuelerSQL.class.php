<?php

require_once("DBConnection.class.php");
require_once("ElternSQL.class.php");

class SchuelerSQL {
    public function habe_ich_kind($elternid){
        $statement = new DBStatement(DBConnection::getInstance());
        $query3="select * from kind where benutzerId = ".$elternid."";
         $statement->executeQuery($query3);
          if ($row = $statement->getNextRow()) {
            return true;
        } else {
            return false;
        }
        
    }
    public function schuelerLoeschen($kindid){
        $statement = new DBStatement(DBConnection::getInstance());
        //wer sind meine Eltern?
        $query1 = "select benutzerid from kind where kindid=".$kindid."";
		$statement->executeQuery($query1);
		//evtl überprüfen, ob diese Spalte = null --> $row["benutzerid"]...
		$row=$statement->getNextRow();
		if (($row["benutzerid"])==null) {
		var_dump($row);
		}
		else {
        $erg = mysql_query($query1);
        $elternid = mysql_result($erg, 0, 0);
		//haben meine Eltern noch weitere Kinder?
         //ja? lass meine Eltern aktiv
        //nein? dann deaktiviere meine Eltern
		if(!$this->habe_ich_kind($elternid)){
            $elternsql= new ElternSQL;
            $elternsql->deaktivieren($elternid);
        }
		}
		        //lösch mich
        $query2="delete from kind where kindid=".$kindid."";
        $statement->executeQuery($query2);
        
        
       
    }
    public function beziehung_kind_eltern($zugangsschluessel, $benutzername) {
        $statement = new DBStatement(DBConnection::getInstance());
        $elternsql = new ElternSQL();
        $query = "update Kind set BenutzerId = " . $elternsql->getBenutzerID($benutzername) . " where zugangsschluessel = '" . $zugangsschluessel . "'";
        
        $statement->executeQuery($query);
    }

    public function zugangsschluessel_loeschen($zugangsschluessel, $benutzername) {
        $statement = new DBStatement(DBConnection::getInstance());
        $elternsql = new ElternSQL();
        $query = "update Kind set Zugangsschluessel = NULL where benutzerid = " . $elternsql->getBenutzerID($benutzername) . "";
       
        $statement->executeQuery($query);
    }

    public function speichern($kindid, $name, $vorname, $geburtsdatum, $strasse, $ort, $plz, $jahrgangsstufe) {
        //$rolle_id = $this->getRole($rolleName);

        $statement = new DBStatement(DBConnection::getInstance());

        $sql = "UPDATE "
                . "kind "
                . "SET "
                . "Name= '$name',"
                . "`Vorname`= '$vorname',"
                . "Geburtsdatum='$geburtsdatum',"
                . "Strasse= '$strasse',"
                . "`PLZ`= '$plz',"
                . "`Ort`= '$ort',"
                . "`jahrgangsstufe`= $jahrgangsstufe"
                . " WHERE KindID = " .$kindid. "";
        print $sql;

        $statement->executeQuery($sql);
    }

    

}
