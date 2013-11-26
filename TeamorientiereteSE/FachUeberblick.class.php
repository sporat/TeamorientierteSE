<?php

require_once("FachListe.class.php");

class FachUeberblick {
	
	public static $CONTENT_ID = "FachOutline";
	
	private $fachListe;
        
	
	public function __construct() {
		$this->fachListe = new FachListe();
	}
	
	public function __toString() {

		$htmlStr = "<table border='1'>";
		$htmlStr .= "<h3>Wählen Sie aus der unteren Liste die Fach aus, die Sie ändern wollen</h3>";
		$htmlStr .= "<tr><th>FachID</th><th>Bezeichnung</th></tr>";
		
		foreach ($this->fachListe->getFach() as $fach) {
			$link = sprintf("<a href='index.php?contentId=fach_aendern_formular&id=%s'>%s</a>", $fach->getFachID(), $fach->getFachID());                        
			$htmlStr .= sprintf("<tr><td>%s</td><td>%s</td></tr>", 
				$link, $fach->getBezeichnung());

                }
		
		$htmlStr .= "</table>";
		return $htmlStr;
	}

}