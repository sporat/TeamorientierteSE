<?php

require_once("TerminBenutzerListe.class.php");

class TerminBenutzerUeberblick {
	
	
	
	private $terminListe;
        
	
	public function __construct() {
		$this->terminListe = new TerminBenutzerListe();
	}
	
	public function __toString() {

		$htmlStr = "<table border='1'>";
		$htmlStr .= "<h3>Wählen Sie aus der unteren Liste den Termin aus, den Sie &auml;ndern wollen</h3>";
		$htmlStr .= "<tr><th>TerminID</th><th>Datum</th><th>Beschreibung</th></tr>";
		
		foreach ($this->terminListe->getTermin() as $termin) {
			$link = sprintf("<a href='index.php?contentId=termin_aendern&id=%s'>%s</a>", $termin->getTerminId(), $termin->getTerminId());                        
			$htmlStr .= sprintf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>", 
				$link, $termin->getTerminID(), $termin->getDatum(), $termin->getBeschreibung());

                }
		
		$htmlStr .= "</table>";
              
		return $htmlStr;
	}

}

