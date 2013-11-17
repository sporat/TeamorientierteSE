<?php

require_once("VerwaltungListe.class.php");

class PasswortAendernUeberblick {
	
	public static $CONTENT_ID = "UserOutline";
	
	private $verwaltungListe;
        
	
	public function __construct() {
		$this->verwaltungListe = new VerwaltungListe();
	}
	
	public function __toString() {

		$htmlStr = "<table border='1'>";
		$htmlStr .= "<h3>Wählen Sie aus der unteren Liste den Benutzer aus, den Sie ändern wollen</h3>";
		$htmlStr .= "<tr><th>MitarbeiterID</th><th>Benutzername</th><th>Vorname</th><th>Nachname</th><th>Passwort</th><th>E-Mail</th><th>Telefon</th><th>Raum</th><th>Rolle</th></tr>";
		
		foreach ($this->verwaltungListe->getAdmin() as $admin) {
			$link = sprintf("<a href='index.php?contentId=passwort_verwalten"
				. "&id=%s'>%s</a>", $admin, $admin);                        
			$htmlStr .= sprintf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>", 
				$link, $admin->getBenutzername(), $admin->getVorname(), $admin->getName(), $admin->getPasswort(), $admin->getEmail(), $admin->getTelefon(), $admin->getRaum(), $admin->getRolle());

                }
		
		$htmlStr .= "</table>";

		return $htmlStr;
	}

}