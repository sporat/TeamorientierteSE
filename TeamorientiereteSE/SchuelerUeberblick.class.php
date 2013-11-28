<?php

require_once("SchuelerListe.class.php");

class SchuelerUeberblick {
	
	public static $CONTENT_ID = "UserOutline";
	
	private $schuelerListe;
        
	
	public function __construct() {
		$this->schuelerListe = new SchuelerListe();
	}
	
	public function __toString() {

		$htmlStr = "<table border='1'>";
		$htmlStr .= "<h3>Wählen Sie aus der unteren Liste den Schüler aus, den Sie ändern wollen</h3>";
		$htmlStr .= "<tr><th>KindID</th><th>Name</th><th>Vorname</th><th>Strasse</th><th>PLZ</th><th>Ort</th><th>Jahrgangsstufe</th></tr>";
		
		foreach ($this->schuelerListe->getSchueler() as $schueler) {
			$link = sprintf("<a href='index.php?contentId=schueler_aendern_formular&id=%s'>%s</a>", $schueler->getKindId(), $schueler->getKindId());                        
			$htmlStr .= sprintf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>", 
				$link, $schueler->getName(), $schueler->getVorname(), $schueler->getStrasse(), $schueler->getPLZ(), $schueler->getOrt(), $schueler->getJahrgangsstufe());

                }
		
		$htmlStr .= "</table>";
      
		return $htmlStr;
	}

}