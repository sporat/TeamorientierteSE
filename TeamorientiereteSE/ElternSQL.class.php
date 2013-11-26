<?php

require_once("DBConnection.class.php");

class ElternSQL {
    /* public function kindElternZuordnung(){
      $statement = new DBStatement(DBConnection::getInstance());
      $query="insert into erziehungsberechtigteKind ()";
      $statement->executeQuery($query);
      } */

    public function load($benutzername) {
        $statement = new DBStatement(DBConnection::getInstance());
        $query = "select * from benutzer where benutzername = '" . $benutzername . "'";
        $statement->executeQuery($query);
        if ($row = $statement->getNextRow()) {
            return true;
        } else {
            return false;
        }      
    }
    public function aktivieren ($benutzerid)
    {
        $statement = new DBStatement(DBConnection::getInstance());
        $query = "update benutzer set status = 0 where benutzerid = ".$benutzerid."";
        $statement->executeQuery($query);
    }
     public function deaktivieren ($benutzerid)
    {
        $statement = new DBStatement(DBConnection::getInstance());
        $query = "update benutzer set status = 1 where benutzerid = ".$benutzerid."";
        if ($statement->executeQuery($query))
		{
		return true;
		}
		else
		{
		return false;
		}
    }
    public function getBenutzerID($benutzername)
    {
       $statement = new DBStatement(DBConnection::getInstance());
        $query = "Select BenutzerID from benutzer where benutzername = '" . $benutzername . "'";
        
        $statement->executeQuery($query);
        $erg = mysql_query($query);
        $id = mysql_result($erg, 0, 0);  
        return $id;
    }
    public function correctKey($zugangsschlüssel) {
        $statement = new DBStatement(DBConnection::getInstance());
        $query = "select * from kind where zugangsschluessel = '" . $zugangsschlüssel . "'";
        $statement->executeQuery($query);
        if ($row = $statement->getNextRow()) {
            return true;
        } else {
            return false;
        }
    }

    public function anlegen($benutzername, $passwort, $name, $vorname, $email, $telefon, $mitteilungsweg, $rolle, $status) {
        $statement = new DBStatement(DBConnection::getInstance());
        $query = "Select (case when MAX(BenutzerID) is null then 1 else MAX(BenutzerID)+1 end) as BenutzerID from Benutzer";
        $statement->executeQuery($query);
        $erg = mysql_query($query);
        $id = mysql_result($erg, 0, 0);

        $query1 = "INSERT INTO "
                . "benutzer(`BenutzerID`, `Benutzername`, `Passwort`, `Name`, `Vorname`, `Email`, `Rolle`, `Telefon`, `Status`) "
                . "VALUES "
                . "($id, '$benutzername', '$passwort', '$name', '$vorname', '$email', '$rolle', '$telefon', '$status')";
        $query2 = "INSERT INTO "
                . "eltern(`BenutzerID`, `Mitteilungsweg`) "
                . "VALUES "
                . "($id,'$mitteilungsweg')";
        //echo $query1;
        //echo $query2;
        $statement->executeQuery($query1);
        $statement->executeQuery($query2);
    }

	public function elternAendern($benutzerid, $benutzername, $name, $vorname, $passwort, $email, $telefon, $mitteilungsweg) {
        $statement = new DBStatement(DBConnection::getInstance());
        $query = "UPDATE benutzer set passwort = '$passwort', name = '$name', vorname='$vorname', email='$email', telefon='$telefon' where benutzerid=$benutzerid";
        
        $query1 = "UPDATE "
                . "eltern set mitteilungsweg = '$mitteilungsweg' "
                . "where benutzerid= $benutzerid ";

        //echo $query1;
        //echo $query2;
        $statement->executeQuery($query);
        $statement->executeQuery($query1);
    }
    public function elternLoeschen($benutzerid) {
      $statement = new DBStatement(DBConnection::getInstance());

      $query = "DELETE FROM `lehrer` WHERE BenutzerID = '$benutzerid'";
	  $query1= "Delete from benutzer where benutzerid = '$benutzerid'";
      $statement->executeQuery($query);
	  $statement->executeQuery($query1);
      } 
}
