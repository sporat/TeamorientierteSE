<?php

require_once("UserList.class.php");

class UserOutline {
	
	public static $CONTENT_ID = "UserOutline";
	
	private $userList;
	
	public function __construct() {
		$this->userList = new UserList();
	}
	
	public function __toString() {

		$htmlStr = "<table border='1'>";
		$htmlStr .= "<h3>Wählen Sie aus der unteren Liste den Benutzer aus, den Sie ändern wollen</h3>";
		$htmlStr .= "<tr><th>MitarbeiterID</th><th>Benutzername</th><th>Vorname</th><th>Nachname</th><th>E-Mail</th><th>Telefon</th><th>Raum</th><th>Rolle</th></tr>";
		
		foreach ($this->userList->getAdmin() as $admin) {
			$link = sprintf("<a href='index.php?contentId=admin_aendern"
				. "&id=%b'>%b</a>", $admin, $admin);
			$htmlStr .= sprintf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>", 
				$link, $admin->getBenutzername(), $admin->getVorname(), $admin->getNachname(), $admin->getEmail(), $admin->getTelefon(), $admin->getRaum(), $admin->getRolle());
		}
		
		$htmlStr .= "</table>";

		return $htmlStr;
	}

}