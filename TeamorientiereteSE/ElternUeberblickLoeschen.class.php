<?php

require_once("ElternListe.class.php");


class ElternUeberblickLoeschen {
	
	public static $CONTENT_ID = "ElternUeberblickLoeschen";
	private $submitKey = "eltern_auswaehlen";
	private $elternListe;
        public $checkbox;
        public $i;
	public $eltern;
	public $statusTxt;
	
	public function __construct() {
		$this->elternListe = new ElternListe();
	}
	
	public function getStatusText()
	{
	return $this->statusTxt;
	}
	
	public function doActions() {
$this->eltern = array(); 

		// Prüfen ob das Formular dieser Sicht übergeben wurde
		if (array_key_exists($this->submitKey, $_REQUEST)) {
		
		if (isset($_REQUEST['ElternDel'])) 
		{
			reset($_REQUEST['ElternDel']);
			$i=0;
			$eltern="";
			foreach ($_REQUEST['ElternDel'] as $k => $v) 
			//$k: Stelle im Array (beginnend mit 0); 
			//$v: Value an der Stelle --> BenutzerId zum Löschen der Eltern
				{
					if ($i==0) {
					$eltern .= $v;
					}
					else {
					$eltern .= "," .$v;
					}
					$i++;
				}
			$_REQUEST['anzahl']=$i;
			$_REQUEST['eltern']= $eltern;
		$elternLoeschen = new ElternLoeschen();

		print $elternLoeschen->__toString();	
		} 
		else 
		{
			$i=0;
			$CONTENT_ID="eltern_loeschen";
			$this->statusTxt = "Sie haben keine Eltern ausgewählt!";
			return $this->__toString();
		}
		                           
                }	
	}

	public function __toString() {
                $i = 0;
					$htmlStr ="";
					
		foreach ($this->elternListe->getEltern() as $eltern) {

                    $form = new Template("ElternUeberblickLoeschen.tmpl.html"); 
                    $elternid = $eltern->getBenutzerID();
//in der Klasse richtige Bezeichnung nachschauen
					
                   if ($eltern->getStatus()==0) {
				   $status="aktiviert";
				   }
				   else
				   {
				   $status="deaktiviert";
				   }
                    $htmlStr .= sprintf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>", 
					"<input type='checkbox' name='ElternDel[]' value='$elternid'>", $eltern->getBenutzername(), $eltern->getName(), $eltern->getVorname(), $eltern->getEmail(), $eltern->getTelefon(), $eltern->getMitteilungsweg(), $status);

                    // Daten des Models eintragen
                    $form->setValue("[htmlStr]", $htmlStr);
				
                }
			
                // erstelltes Formular zurück geben
            return $form->__toString();
        }

}