<?php

require_once("LehrerListe.class.php");
require_once("LehrerLoeschen.class.php");

class LehrerUeberblickLoeschen {
	
	public static $CONTENT_ID = "LehrerUeberblickLoeschen";
	private $submitKey = "lehrer_auswaehlen";
	private $lehrerListe;
        public $checkbox;
        public $i;
	
	public function __construct() {
		$this->lehrerListe = new LehrerListe();
	}
	public function doActions() {

		// Prüfen ob das Formular dieser Sicht übergeben wurde
		if (array_key_exists($this->submitKey, $_REQUEST)) {
                   
if (isset($_REQUEST['LehrerDel'])) 
		{
			reset($_REQUEST['LehrerDel']);
			$i=0;
			$lehrer="";
			foreach ($_REQUEST['LehrerDel'] as $k => $v) 
			//$k: Stelle im Array (beginnend mit 0); 
			//$v: Value an der Stelle --> KindId zum Löschen des Kindes
				{
					if ($i==0) {
					$lehrer .= $v;
					}
					else {
					$lehrer .= "," .$v;
					}
					$i++;
				}
			$_REQUEST['anzahl']=$i;
			$_REQUEST['lehrer']= $lehrer;
		$lehrerLoeschen = new LehrerLoeschen();
		print $lehrerLoeschen->__toString();	
		} 
		else 
		{
			$i=0;
			$contentId="lehrer_loeschen";
			$this->statusTxt = "Sie haben keine Lehrer ausgewählt!";
			return $this->__toString();
		}
		                           
               }
                            
                }	
        
	public function __toString() {
                $i = 0;
		 $htmlStr ="";
		foreach ($this->lehrerListe->getLehrer() as $lehrer) {
                
			//$link = sprintf("<a href='index.php?contentId=lehrer_aendern &id=%s'>%s</a>", $lehrer, $lehrer);
                    $form = new Template("LehrerUeberblickLoeschen.tmpl.html"); 
                    $benutzerID = $lehrer->getBenutzerID();
                    if($lehrer->getKlassenlehrer()==0) 
					{
					$klassenlehrer = "Kein Klassenlehrer";
					}
					else
					{
					$klassenlehrer = "Klassenlehrer";
					}

                   
                    $htmlStr .= sprintf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>", 
				"<input type='checkbox' name='LehrerDel[]' value='$benutzerID'>", $lehrer->getBenutzerID(), $lehrer->getBenutzername(), $lehrer->getVorname(), $lehrer->getName(), $lehrer->getPasswort(), $lehrer->getEmail(), $lehrer->getTelefon(), $lehrer->getRaum(), $lehrer->getRolle(), $lehrer->getSprechstundeTag(), $lehrer->getSprechstundeZeit(), $lehrer->getFunktion(), $klassenlehrer);

                    // Daten des Models eintragen
                    $form->setValue("[htmlStr]", $htmlStr);
				
                }
                // erstelltes Formular zurück geben
                return $form->__toString();
        }

}