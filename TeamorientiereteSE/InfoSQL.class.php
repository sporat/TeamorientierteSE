<?php

require_once("DBConnection.class.php");

class InfoSQL {
  public function infoKlasseZuordnen($terminid, $klassenid)
  { 
      $statement = new DBStatement(DBConnection::getInstance());

        $sql = "INSERT INTO "
                .   "informationklasse (infoid, klasseid) "
                . "VALUES "
                .   "($infoid,$klassenid)";  
        print $sql;
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
       print $query;
        $statement->executeQuery($query);
		return true;
    }

    

    

}
