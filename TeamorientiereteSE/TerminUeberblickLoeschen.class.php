<?php

require_once("TerminBenutzerListe.class.php");

class TerminUeberblickLoeschen {
	
        
	
	public function __construct() {
		$this->terminListe = new TerminBenutzerListe();
	}
        public static $CONTENT_ID = "TerminUeberblickLoeschen";
	private $submitKey = "termin_auswaehlen";
	private $terminListe;
        public $checkbox;
        public $i;
	public $termin;
	public $statusTxt;
	
	
	public function getStatusText()
	{
	return $this->statusTxt;
	}
	public function doActions() {
$this->termin = array(); 
//array_push($this->kinder, $kind);
		// Prüfen ob das Formular dieser Sicht übergeben wurde
		if (array_key_exists($this->submitKey, $_REQUEST)) {
		
		if (isset($_REQUEST['TerminDel'])) 
		{
			reset($_REQUEST['TerminDel']);
			$i=0;
			$kind="";
			foreach ($_REQUEST['TerminDel'] as $k => $v) 
			//$k: Stelle im Array (beginnend mit 0); 
			//$v: Value an der Stelle --> KindId zum Löschen des Kindes
				{
					if ($i==0) {
					$kind .= $v;
					}
					else {
					$kind .= "," .$v;
					}
					$i++;
				}
			$_REQUEST['anzahl']=$i;
			//$_REQUEST['kindarr[]']=$_REQUEST['KindDel'];
			$_REQUEST['termin']= $termin;
		$terminLoeschen = new TerminLoeschen();
		print $terminLoeschen->__toString();	
		} 
		else 
		{
			$i=0;
			$contentId="termin_loeschen";
			$this->statusTxt = "Sie haben keine Termine ausgewählt!";
			return $this->__toString();
		}
		                           
                }	
	}

	
	public function __toString() {
                $i = 0;
				$checkbox ="";
					$htmlStr ="";
                $form = new Template("TerminUeberblickLoeschen.tmpl.html"); 
               
                foreach ($this->terminListe->getTermin() as $termin) {
                    $terminid = $termin->getTerminId();
                    $checkbox .= "<input type='checkbox' name='TerminDel[]' value='$terminid'>";
                   
                    $htmlStr .= sprintf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>", 
					"<input type='checkbox' name='TerminDel[]' value='$terminid'>", $termin->getTerminid(), $termin->getBeschreibung(),  $termin->getDatum(), $termin->getZeit(), $termin->getOrt(), $termin->getVerantwortlicher());

                    // Daten des Models eintragen
                    $form->setValue("[htmlStr]", $htmlStr);
                    
		

		
		$htmlStr .= "</table>";
              
		return $htmlStr;
	}

}
}
