<?php

require_once("DBConnection.class.php");

class LehrerSQL {

    public function exists($benutzername) {
        $statement = new DBStatement(DBConnection::getInstance());
        $query = "Select * from Benutzer where Benutzername = '" . $benutzername . "' ";
        $statement->executeQuery($query);
        if ($row = $statement->getNextRow()) {
            return true;
        } else {
            return false;
        }
    }

    public function anlegen($benutzername, $passwort, $name, $vorname, $email, $telefon, $raum, $rolle, $sprechstundeWochentag, $sprechstundeUhrzeit, $funktion, $klassenlehrer, $status) {
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
                . "`Lehrer`(`BenutzerID`, `Sprechstunde_Tag`, `Sprechstunde_Uhrzeit`, `Raum`, `Funktion`, `Klassenlehrer`) "
                . "VALUES "
                . "($id,'$sprechstundeWochentag','$sprechstundeUhrzeit','$raum','$funktion', $klassenlehrer)";

        $statement->executeQuery($query1);
        $statement->executeQuery($query2);

        /* if($klassenlehrer = 1) {
          $query3 = "INSERT INTO "
          .   "`klassenlehrer`(`BenutzerID`, `KlasseID`) "
          . "VALUES "
          .   "($id,1)";
          $statement->executeQuery($query3);
          } */ //später, wenn Klassenlehrer sich seine Klasse anlegt F120
    }

    public function lehrerLoeschen($benutzerid) {
        $statement = new DBStatement(DBConnection::getInstance());

        $query = "DELETE FROM `lehrer` WHERE BenutzerID = '$benutzerid'";
        $query2 = "Delete from benutzer where benutzerID ='$benutzerid'";

        $statement->executeQuery($query);
        $statement->executeQuery($query2);
    }

    public function setKlassenlehrer($benutzerid) {
        $statement = new DBStatement(DBConnection::getInstance());

        $query = "update Lehrer set Klassenlehrer = 1 where benutzerid = ".$benutzerid."";
         $query2 ="update Benutzer set Rolle = 'Klassenlehrer' where benutzerid = ".$benutzerid."";
         
            
        $statement->executeQuery($query);
 
        $statement->executeQuery($query2);
    }

    public function resetKlassenlehrer($benutzerid) {
        $statement = new DBStatement(DBConnection::getInstance());

        $query = "update Lehrer set Klassenlehrer = 0 where benutzerid = ".$benutzerid."";
        $query2 ="update Benutzer set Rolle = 'Lehrer' where benutzerid = ".$benutzerid."";
        
            
        $statement->executeQuery($query);
        $statement->executeQuery($query2);
    }

    public function hatKlassenleitung($benutzerId) {
        $statement = new DBStatement(DBConnection::getInstance());

        $query = "select * from klassenlehrer where benutzerid = ".$benutzerId."";
        

        $statement->executeQuery($query);
        if ($row = $statement->getNextRow()) {
            return true;
        } else {
            return false;
        }
    }

}
