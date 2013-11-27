<?php

require_once("DBConnection.class.php");
require_once("Info.class.php");

class InfoSQL extends Info {
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

     public function laden($infoid) {
        $statement = new DBStatement(DBConnection::getInstance());

        $statement->executeQuery("SELECT * FROM Information WHERE infoid = $infoid;");
        if ($row = $statement->getNextRow()) {
            $this->infoid = $infoid;
            $this->bezeichnung = $row["bezeichnung"];
		$this->textfeld = $row["text"];
		$this->gültigkeitsdatum = $row["gültigkeitsdatum"];
		$this->benutzerID = $row["benutzerID"];
                $this->einstellungsdatum = $row["einstellungsdatum"];

            return true;
        }
        return false;
    }
    
    public function aendern($infoid, $gültigkeitsdatum, $textfeld, $bezeichnung, $benutzerID) {
        $statement = new DBStatement(DBConnection::getInstance());
        $query = "UPDATE information set Gültigkeitsdatum = $gültigkeitsdatum, Textfeld = $textfeld, Bezeichnung = $bezeichnung, BenutzerID = $benutzerID, Einstellungsdatum = CURRENT_TIMESTAMP, where infoid=$infoid";
       if ($statement->executeQuery($query)) 
         {
            return true;
        }
        else
        {
        return false;
        }
    }
    

    

}
