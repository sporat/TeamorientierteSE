<?php

require_once("SucheLehrerListe.class.php");

class SucheLehrerUeberblick {
	
	public static $CONTENT_ID = "SucheLehrerOutline";
	
	private $sucheLehrerListe;
        
	
	public function __construct() {
		$this->sucheLehrerListe = new SucheLehrerListe();
	}
	
	public function __toString() {

		$htmlStr = "<table border='1'>";
		$htmlStr .= "<h3>Wählen Sie einen Benutzer aus, um dessen Profil zu besuchen:</h3>";
		$htmlStr .= "<tr><th>BenutzerID</th><th>Benutzername</th><th>Vorname</th><th>Nachname</th><th>E-Mail</th></tr>";
		
		foreach ($this->sucheLehrerListe->getLehrer() as $lehrer) {
			$link = sprintf("<a href='index.php?contentId=sucheLehrer_zu_profil"
				. "&benutzerid=%s'>%s</a>", $lehrer->getBenutzerID(), $lehrer->getBenutzerID());                        
			$htmlStr .= sprintf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>", 
				$link,  $lehrer->getBenutzername(), $lehrer->getVorname(), $lehrer->getName(), $lehrer->getEmail());

                }
		
		$htmlStr .= "</table>";

		return $htmlStr;
	}

}