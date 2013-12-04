<?php

require_once("KlassenlehrerListe.class.php");

class KlassenlehrerUeberblick {
	
	public static $CONTENT_ID = "UserOutline";
	
	private $klassenlehrerListe;
        
	
	public function __construct() {
		$this->klassenlehrerListe = new KlassenlehrerListe();
	}
	
	public function __toString() {

		$htmlStr = "<table border='1'>";
		$htmlStr .= "<h3>Wählen Sie aus der unteren Liste den Benutzer aus, den Sie ändern wollen</h3>";
		$htmlStr .= "<tr><th>MitarbeiterID</th><th>Benutzername</th><th>Vorname</th><th>Nachname</th><th>E-Mail</th><th>Telefon</th><th>Rolle</th></tr>";
		
		foreach ($this->klassenlehrerListe->getKlassenlehrer() as $klassenlehrer) {
			$link = sprintf("<a href='index.php?contentId=systemadministrator_klassen_ohne_leiter_liste"
				. "&id=%s'>%s</a>", $klassenlehrer, $klassenlehrer);                        
			$htmlStr .= sprintf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>", 
				$link, $klassenlehrer->getBenutzername(), $klassenlehrer->getVorname(), $klassenlehrer->getName(),  $klassenlehrer->getEmail(), $klassenlehrer->getTelefon(), $klassenlehrer->getRolle());

                }
		
		$htmlStr .= "</table>";

		return $htmlStr;
	}

}