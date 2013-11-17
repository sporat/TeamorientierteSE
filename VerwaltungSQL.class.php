<?php

require_once("DBConnection.class.php");

/**
 * Description of VerwaltungSQL
 *
 * @author Basti
 */
class VerwaltungSQL {
   
    public function anlegen($benutzername, $passwort, $name, $vorname, $email, $telefon, $raum, $rolle) {
        $statement = new DBStatement(DBConnection::getInstance());
        $query = "Select (case when MAX(BenutzerID) is null then 1 else MAX(BenutzerID)+1 end) as BenutzerID from Benutzer";
        $statement->executeQuery($query);
        $erg = mysql_query($query);
        $id = mysql_result($erg,0,0);
        
        $query1 = "INSERT INTO "
                .   "benutzer(`BenutzerID`, `Benutzername`, `Passwort`, `Name`, `Vorname`, `Email`, `Rolle`, `Telefon`) "
                . "VALUES "
                .   "($id, '$benutzername', '$passwort', '$name', '$vorname', '$email', '$rolle', '$telefon')";  
        $query2 = "INSERT INTO "
                .   "`verwaltung`(`BenutzerID`) "
                . "VALUES "
                .   "($id)";
        
        $statement->executeQuery($query1);
        $statement->executeQuery($query2);
    }
    
    /*Hier sollte noch eine Funktion implementiert werden, dass der zufällig generierte Zugangsschlüssel nicht bereits vorhanden ist.
      Ist dieser bereits vorhanden, soll solange ein weiterer generiert werden, bis er einzigartig ist.*/
    public function ueberpruefeZugangsschluessel($zugangsschluessel){
        
    }
    
    public function schuelerAnlegen($zugangsschluessel, $name, $vorname, $geburtsdatum, $strasse, $plz, $ort, $jahrgangsstufe, $klasse, $benutzerID) {
        $statement = new DBStatement(DBConnection::getInstance());
        $query = "Select (case when MAX(KindID) is null then 1 else MAX(KindID)+1 end) as KindID from Kind";
        $statement->executeQuery($query);
        $erg = mysql_query($query);
        $id = mysql_result($erg,0,0);
        
        $query = "INSERT INTO "
                .   "`kind`"
                .       "(`KindID`, `Jahrgangsstufe`, `Name`, `Vorname`, `Geburtsdatum`, `Strasse`, `PLZ`, `Ort`, `Zugangsschluessel`, `BenutzerID`, `KlasseID`) "
                . "VALUES "
                . "     ('$id','$jahrgangsstufe','$name','$vorname','$geburtsdatum','$strasse','$plz','$ort','$zugangsschluessel','$benutzerID','$klasse')";
        $statement->executeQuery($query);
    }
}
