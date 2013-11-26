<?php

require_once("LehrerListe.class.php");

class LehrerUeberblick {
	
	public static $CONTENT_ID = "LehrerUeberblick";
	
	private $lehrerListe;
        
	
	public function __construct() {
		$this->lehrerListe = new LehrerListe();
	}
	
	public function __toString() {

		$htmlStr = "<table border='1'>";
		$htmlStr .= "<h3>Wählen Sie aus der unteren Liste den Benutzer aus, den Sie ändern wollen</h3>";
		$htmlStr .= "<tr><th>LehrerID</th><th>Benutzername</th><th>Vorname</th><th>Nachname</th><th>Passwort</th><th>E-Mail</th><th>Telefon</th><th>Raum</th><th>Rolle</th><th>Sprechstunde Wochentag</th><th>Sprechstunde Uhrzeit</th><th>Funktion</th><th>Klassenlehrer</th></tr>";
		
		foreach ($this->lehrerListe->getLehrer() as $lehrer) {
			$link = sprintf("<a href='index.php?contentId=lehrer_aendern&id=%s'>%s</a>", $lehrer, $lehrer);    
				                     
			$htmlStr .= sprintf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>", 
				$link, $lehrer->getBenutzername(), $lehrer->getVorname(), $lehrer->getName(), $lehrer->getPasswort(), $lehrer->getEmail(), $lehrer->getTelefon(), $lehrer->getRaum(), $lehrer->getRolle(), $lehrer->getSprechstundeTag(), $lehrer->getSprechstundeZeit(), $lehrer->getFunktion(), $lehrer->getKlassenlehrer());

                }
		
		$htmlStr .= "</table>";
                
		return $htmlStr;
	}

}