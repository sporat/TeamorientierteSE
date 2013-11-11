<?php
    require_once 'VerwaltungSQL.class.php';


/**
 * Description of Verwaltung
 In dieser Klasse wird das Anlegen, Ändern und Löschen von Admins behandelt
 
 * @author Basti
 */
class Verwaltung extends User{
    
    private $submitKey = "admin_anlegen_bestaetigen";
    private $statusText;
    
    	public function doActions() {
            
		if (array_key_exists($this->submitKey, $_POST)) {
                    $benutzername = $_POST['benutzername'];
                    $passwort = $_POST['passwort'];
                    $name = $_POST['name'];
                    $vorname = $_POST['vorname'];
                    $nachname = $_POST['nachname'];
                    $email = $_POST['email'];
                    $telefon = $_POST['telefon'];
                    $raum = $_POST['raum'];
                    $datenbank = $_POST['datenbank'];
                    $rolleid = $_POST['rolleid'];
                    
                    $verwaltungSQL = new VerwaltungSQL();
                    if($verwaltungSQL->anlegen($benutzername, $passwort, $name, $vorname, $nachname, $email, $telefon, $raum, $rolleid)) {
                        $this->statusText = "Der Benutzer $benutzername wurde erfolgreich angelegt";
                    } else $this->statusText = "Der Benutzer $benutzername konnte nicht angelegt werden. Bitte überprüfen sie Ihre Eingabe.";
			
		} 
	}
        
	public function getStatusText() {
		return $this->statusText;
	}	
        
	public function __toStringAdminAnlegen() {
		$form = new Template("AdminAnlegen.tmpl.html");
		return $form->__toString();
				
	}
}
