<?php

require_once("DBConnection.class.php");

/**
 * Description of VerwaltungSQL
 *
 * @author Basti
 */
class VerwaltungSQL {
   
    public function anlegen($benutzername, $passwort, $name, $vorname, $nachname, $email, $telefon, $raum, $rolleid) {
        $connect = new DBConnection();
	$statement = new DBStatement($connect);
    
        $query1 = "INSERT INTO "
                .   "benutzer(`BenutzerID`, `Benutzername`, `Passwort`, `Name`, `Vorname`, `Nachname`, `Email`, `RolleID`, `Telefon`) "
                . "VALUES "
                .   "(2, '$benutzername', '$passwort', '$name', '$vorname', '$nachname', '$email', '$rolleid', '$telefon')";  
        $query2 = "INSERT INTO "
                .   "`admin`(`BenutzerID`, `Raum`) "
                . "VALUES "
                .   "(2, '$raum')";
        $statement->executeQuery($query1);
        $statement->executeQuery($query2);
    }
}
