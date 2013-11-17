<?php

require_once("LehrerListe.class.php");

class LehrerUeberblickLoeschen {
	
	public static $CONTENT_ID = "LehrerUeberblickLoeschen";
	private $submitKey = "lehrer_loeschen_bestaetigen";
	private $lehrerListe;
        public $checkbox;
        public $i;
	
	public function __construct() {
		$this->lehrerListe = new LehrerListe();
	}
	public function doActions() {

		// Prüfen ob das Formular dieser Sicht übergeben wurde
		if (array_key_exists($this->submitKey, $_REQUEST)) {
                    $benutzerid = $_POST["checkbox_loeschen"];
                    $lehrerSQL = new LehrerSQL();
                    $lehrerSQL->lehrerLoeschen($benutzerid);
                            
                }	
	}
        
	public function __toString() {
                $i = 0;
		
		foreach ($this->lehrerListe->getLehrer() as $lehrer) {
                    //$htmlStr = "";
			//$link = sprintf("<a href='index.php?contentId=lehrer_aendern &id=%s'>%s</a>", $lehrer, $lehrer);
                    $form = new Template("LehrerUeberblickLoeschen.tmpl.html"); 
                    $benutzerID = $lehrer->getBenutzerID();
                    $checkbox .= "<input type='checkbox' name='checkbox_loeschen' value='$benutzerID'>";
                    
                    $htmlStr .= sprintf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>", 
				$lehrer->getBenutzerID(), $lehrer->getBenutzername(), $lehrer->getVorname(), $lehrer->getName(), $lehrer->getPasswort(), $lehrer->getEmail(), $lehrer->getTelefon(), $lehrer->getRaum(), $lehrer->getRolle(), $lehrer->getSprechstundeTag(), $lehrer->getSprechstundeZeit(), $lehrer->getFunktion(), $lehrer->getKlassenlehrer(), "<input type='checkbox' name='checkbox_loeschen' value=''>");

                    // Daten des Models eintragen
                    $form->setValue("[htmlStr]", $htmlStr);
                    $form->setValue("[checkbox]", $checkbox);
                    
                            
		
				
                }
                // erstelltes Formular zurück geben
                return $form->__toString();
        }

}