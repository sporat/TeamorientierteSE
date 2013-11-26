<?php

require_once("UserListe.class.php");

class PasswortAendernUeberblick {
	
	public static $CONTENT_ID = "UserOutline";
	
	private $userListe;
        
	
	public function __construct() {
		$this->userListe = new UserListe();
	}
	
	public function __toString() {

		$htmlStr = "<table border='1'>";
		$htmlStr .= "<h3>Wählen Sie aus der unteren Liste den Benutzer aus, den Sie ändern wollen</h3>";
		$htmlStr .= "<tr><th>Benutzername</th><th>Vorname</th><th>Nachname</th><th>Passwort</th><th>Rolle</th></tr>";
		
		foreach ($this->userListe->getUser() as $user) {
			$link = sprintf("<a href='index.php?contentId=passwort_verwalten"
				. "&benutzername=%s'>%s</a>", $user->getBenutzername(), $user->getBenutzername());                        
			$htmlStr .= sprintf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>", 
				$link,  $user->getVorname(), $user->getName(), $user->getPasswort(), $user->getRole());

                }
		
		$htmlStr .= "</table>";

		return $htmlStr;
	}

}