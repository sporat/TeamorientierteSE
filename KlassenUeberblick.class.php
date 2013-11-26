<?php

require_once("Klassenliste.class.php");
require_once("Klasse.class.php");

class KlassenUeberblick {
	
	
	
	private $klassenListe;
        
	
	public function __construct() {
		$this->klassenListe = new KlassenListe();
	}
	
	public function __toString() {
                $htmlStr ="";
		$checkbox = "";
		$htmlStr .= "<h3>Wählen Sie aus der unteren Liste betroffene Klassen aus</h3>";
		$htmlStr .= "<tr><th>KlassenID</th><th>Jahrgangstufe</th><th>Bezeichung</th><th>Betroffen?</th></tr>";
		
		foreach ($this->klassenListe->getKlasse() as $klasse) {
                                  
                     $klassenid= $klasse->getKlassenId();
                     $checkbox .= "<input type='checkbox' name='Auswahl[]' value= '$klassenid'>";                      
                     $htmlStr .= sprintf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>", $klasse->getKlassenId(), $klasse->getJahrgangsstufe(), $klasse->getBezeichnung(),"<input type='checkbox' name='Auswahl[]' value='$klassenid'>");

		
		

		
	}
return $htmlStr;

        }
                }