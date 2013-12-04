<?php

require_once("LehrerKlasseListe.class.php");

class LehrerKlasseUeberblick {
	
	public static $CONTENT_ID = "UserOutline";
	
	private $klassenListe;
        
	
	public function __construct() {
		$this->klassenListe = new LehrerKlasseListe();
	}
	
	public function __toString() {

		$htmlStr = "";
		$htmlStr .= "<h3>Wählen Sie die Klasse aus, für welche Sie die Schuelerliste einsehen wollen</h3>";
				
		foreach ($this->klassenListe->getKlasse() as $klasse) {
			$htmlStr .= sprintf("<a href='index.php?contentId=klasse_einsehen&klassenid=%s&jahrgang=%s&kuerzel=%s'>%s%s</a>", $klasse->getKlassenId(), $klasse->getJahrgangsstufe(), $klasse->getBezeichnung(), $klasse->getJahrgangsstufe(), $klasse->getBezeichnung());                        
			$htmlStr .= sprintf("<br>"); 
                }
		
		return $htmlStr;
	}

}