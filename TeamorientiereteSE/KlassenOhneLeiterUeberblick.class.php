<?php
//
require_once("KlassenOhneLeiterListe.class.php");
require_once("KlasseOhneLeiterInfo.class.php");

class KlassenOhneLeiterUeberblick {
	
	public static $CONTENT_ID = "KlassenOhneLeiterOutline";
	
	private $klassenOhneLeiterListe;
       	
	public function __construct() {
		$this->klassenOhneLeiterListe = new KlassenOhneLeiterListe();
	}
        
        public function doActions() {
                $klasseid = $_REQUEST["id"];
                
		$klassenOhneLeiterInfo = new KlasseOhneLeiterInfo();
		$klassenOhneLeiterInfo->zuKlassenleiterMachen($klasseid, User::getInstance()->getBenutzerId());
	}
	
	public function __toString() {
                $klassenOhneLeiterInfo = new KlasseOhneLeiterInfo();
                $klassenleiter = $klassenOhneLeiterInfo->KlassenleitungUeberpruefen(User::getInstance()->getBenutzerId());
                if($klassenleiter = 1) {
                
		$htmlStr = "<table border='1'>";
		$htmlStr .= "<h3>Wählen Sie aus der unteren Liste die Klasse aus, der Sie sich zuordnen möchten:</h3>";
		$htmlStr .= "<tr><th>KlasseID</th><th>Jahrgangsstufe</th><th>Kürzel</th></tr>";
		
		foreach ($this->klassenOhneLeiterListe->getKlasse() as $klasse) {
			$link = sprintf("<a href='index.php?contentId=zu_klasse_zuordnen"
				. "&id=%s'>%s</a>", $klasse, $klasse);                        
			$htmlStr .= sprintf("<tr><td>%s</td><td>%s</td><td>%s</td></tr>", 
				$link, $klasse->getJahrgangsstufe(), $klasse->getKuerzel());

                }
		
		$htmlStr .= "</table>";

		return $htmlStr;
                } else return "bereits klassenleiter";   
	}

}