<?php

require_once("FachListe.class.php");

class LehrerFachZuordnungLoeschenUeberblick{
	
        
	
	public function __construct() {
		$this->fachliste = new FachListe();
	}
        public static $CONTENT_ID = "zuordnung_fach_loeschen";
	private $submitKey = "fach_zuordn_loeschen";
	private $fachliste;
        public $checkbox;
        public $i;
	public $termin;
	public $statusTxt;
	
	
	public function getStatusText()
	{
	return $this->statusTxt;
	}
        
	public function doActions() {
            
$this->fach = array(); 
//array_push($this->kinder, $kind);
		// Prüfen ob das Formular dieser Sicht übergeben wurde
		if (array_key_exists($this->submitKey, $_REQUEST)) {
		
		if (isset($_REQUEST['FachDel'])) 
		{
			reset($_REQUEST['FachDel']);
			$i=0;
			$fach="";
			foreach ($_REQUEST['FachDel'] as $k => $v) 
			//$k: Stelle im Array (beginnend mit 0); 
			//$v: Value an der Stelle --> KindId zum Löschen des Kindes
				
		$lehrerSQL = new LehrerSQL();
		
					
					if($lehrerSQL->deleteFachZuordnung($v)){
                                       
				
			$this->statusTxt .= "Zuordnung zu ausgewählten Fächern wurde erfolgreich gelöscht";
                }
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
                $form = new Template("LehrerFachZuordnungLoeschen.tmpl.html"); 
               
                foreach ($this->fachliste->getFach() as $fach) {
                    $fachid = $fach->getFachId();
                    $checkbox .= "<input type='checkbox' name='FachDel[]' value='$fachid'>";
                   
                    $htmlStr .= sprintf("<tr><td>%s</td><td>%s</td></tr>", 
					"<input type='checkbox' name='FachDel[]' value='$fachid'>", $fach->getBezeichnung());

                    // Daten des Models eintragen
                    
                    
                }

		
		$htmlStr .= "</table>";
                $form->setValue("[htmlStr]", $htmlStr);
                
		return $form->__toString();
	}


}
