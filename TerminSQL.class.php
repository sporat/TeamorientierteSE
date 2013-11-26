<?php

require_once("DBConnection.class.php");


class TerminSQL {
    
    
    public function anlegen($beschreibung, $ort, $infoschreiben, $verantwortlicher, $benutzernummer, $datum, $uhrzeit) {
       

        $statement = new DBStatement(DBConnection::getInstance());

        $sql = "INSERT INTO "
                .   "termin (`BenutzerID`, Beschreibung, Ort, infoschreiben, Verantwortlicher, Datum, Uhrzeit) "
                . "VALUES "
                .   "($benutzernummer, '$beschreibung', '$ort', '$infoschreiben', '$verantwortlicher', '$datum', '$uhrzeit')";  
                $statement->executeQuery($sql);
         $sql2="select max(terminid) as terminid from termin";
         $statement->executeQuery($sql2);
         $row=$statement->getNextRow();
         return $row['terminid'];
        
    }
    public function terminKlasseZuordnen($terminid, $klassenid){
        $statement = new DBStatement(DBConnection::getInstance());

        $sql = "INSERT INTO "
                .   "klassentermin (terminid, klasseid) "
                . "VALUES "
                .   "($terminid,$klassenid)";  
        print $sql;
              if(  $statement->executeQuery($sql)){
                return true;
              }
              else 
              {
                  return false;
              }
        
    }

    

}
