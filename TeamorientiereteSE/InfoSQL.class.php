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
		return true;
    }

     public function laden($infoid) {
        $statement = new DBStatement(DBConnection::getInstance());

        $statement->executeQuery("SELECT * FROM Information WHERE infoid = $infoid;");
        if ($row = $statement->getNextRow()) {
            $this->infoid = $infoid;
            $this->bezeichnung = $row["Bezeichnung"];
		$this->textfeld = $row["Text"];
		$this->gültigkeitsdatum = $row["Gueltigkeitsdatum"];
		$this->benutzerID = $row["BenutzerID"];
                $this->einstellungsdatum = $row["Erstellungsdatum"];

            return true;
        }
        return false;
    }
    
    public function aendern($infoid, $gültigkeitsdatum, $textfeld, $bezeichnung) {
        $statement = new DBStatement(DBConnection::getInstance());
        $benutzerID = User::getInstance()->getBenutzerId();
        $query = "UPDATE information set Gueltigkeitsdatum = '".$gültigkeitsdatum."', Text = '".$textfeld."', Bezeichnung = '".$bezeichnung."', BenutzerID = $benutzerID, Erstellungsdatum = CURRENT_TIMESTAMP where infoid=$infoid";
       if ($statement->executeQuery($query)) 
         {
            return true;
        }
        else
        {
        return false;
        }
    }
    
public function infoKlasseCheck ($infoid, $klassenid)
{
     $statement = new DBStatement(DBConnection::getInstance());
     $query = "Select klasseid from informationklasse where infoid = $infoid";
}
    

}
