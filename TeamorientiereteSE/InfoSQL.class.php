<?php

require_once("DBConnection.class.php");

class InfoSQL {
  public function infoKlasseZuordnen($infoid, $klassenid)
  { 
      $statement = new DBStatement(DBConnection::getInstance());

        $sql = "INSERT INTO "
                .   "informationklasse (infoid, klasseid) "
                . "VALUES "
                .   "($infoid,$klassenid)";  
              if(  $statement->executeQuery($sql)){
                return true;
              }
              else 
              {
                  return false;
              }
  }

    public function anlegen($gültigkeitsdatum, $textfeld, $bezeichnung, $benutzerID) {
        $statement = new DBStatement(DBConnection::getInstance());
        $query = "insert into Information (`Bezeichnung`, `BenutzerID`, `Gueltigkeitsdatum`, `Text`) VALUES ('".$bezeichnung."', ".$benutzerID.", '".$gültigkeitsdatum."', '".$textfeld."')";
        $statement->executeQuery($query);
         $sql2="select max(infoid) as infoid from information";
         $statement->executeQuery($sql2);
         $row=$statement->getNextRow();
         return $row['infoid'];
    }

    

    

}
