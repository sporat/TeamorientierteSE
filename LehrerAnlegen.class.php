<?php
    require_once 'LehrerSQL.class.php';


/**
 * Description of Verwaltung
 In dieser Klasse wird das Anlegen, Ändern und Löschen von Admins behandelt
 
 * @author Basti
 */
class LehrerAnlegen {
    
    private $submitKey = "lehrer_anlegen_bestaetigen";
    private $statusText;
    
    	public function doActions() {
            
		if (array_key_exists($this->submitKey, $_POST)) {
                    $benutzername = $_POST['benutzername'];
                    $passwort = $_POST['passwort'];
                    $name = $_POST['name'];
                    $vorname = $_POST['vorname'];
                    $email = $_POST['email'];
                    $telefon = $_POST['telefon'];
                    $raum = $_POST['raum'];
                    $status = $_POST['status'];
                    //$datenbank = $_POST['datenbank'];
                    $rolle = $_POST['rolle'];
                    $sprechstundeWochentag = $_POST['sprechstundeWochentag'];
                    $sprechstundeUhrzeit = $_POST['sprechstundeUhrzeit'];
                    $funktion = $_POST['funktion'];
                    $klassenlehrer =  $_POST['klassenlehrer'];
                    
                    $lehrerAnlegen = new LehrerSQL();
                    $lehrerAnlegen->anlegen($benutzername, $passwort, $name, $vorname, $email, $telefon, $raum, $rolle, $sprechstundeWochentag, $sprechstundeUhrzeit, $funktion, $klassenlehrer, $status);
		} 
	}
        
	public function getStatusText() {
		return $this->statusText;
	}	
        
	public function __toString() {
		$form = new Template("LehrerAnlegen.tmpl.html");
		return $form->__toString();
				
	}
}
