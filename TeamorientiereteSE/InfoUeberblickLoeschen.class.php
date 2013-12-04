<?php

require_once("InfoBenutzerListe.class.php");
require_once("InfoListe.class.php");

class InfoUeberblickLoeschen {
	
        
	public static $CONTENT_ID = "TerminUeberblickLoeschen";
	private $submitKey = "info_auswaehlen";
	private $infoListe;
        public $checkbox;
        public $i;
	public $info;
	public $statusTxt;
        
	public function __construct() {
            if (User::getInstance()->getRole()=="Verwaltung")
            {
                $this->infoListe = new InfoListe();
            }
        else {
             $this->infoListe = new InfoBenutzerListe();
     
             }
		
	}
        
	
	
	public function getStatusText()
	{
	return $this->statusTxt;
	}
	public function doActions() {
$this->info = array(); 
//array_push($this->kinder, $kind);
		// Prüfen ob das Formular dieser Sicht übergeben wurde
		if (array_key_exists($this->submitKey, $_REQUEST)) {
		
		if (isset($_REQUEST['InfoDel'])) 
		{
			reset($_REQUEST['InfoDel']);
			$i=0;
			$info="";
			foreach ($_REQUEST['InfoDel'] as $k => $v) 
			//$k: Stelle im Array (beginnend mit 0); 
			//$v: Value an der Stelle --> KindId zum Löschen des Kindes
				{
					if ($i==0) {
					$info .= $v;
					}
					else {
					$info .= "," .$v;
					}
					$i++;
				}
			$_REQUEST['anzahl']=$i;
			$_REQUEST['info']= $info;
                       
		//$infoLoeschen = new InfoLoeschen();
                $_REQUEST['contentId']="info_loeschen";
		//print $infoLoeschen->__toString();	
		} 
		else 
		{
			$i=0;
                        $_POST['contentId']="information_loeschen";
			$this->statusTxt = "Sie haben keine Informationen ausgewählt!";
			return $this->__toString();
		}
		                           
                }	
	}

	
	public function __toString() {
                $i = 0;
				$checkbox ="";
					$htmlStr ="";
                $form = new Template("InfoUeberblickLoeschen.tmpl.html"); 
               
                foreach ($this->infoListe->getInfo() as $information) {
                    $infoid = $information->getInfoId();
                    $checkbox .= "<input type='checkbox' name='InfoDel[]' value='$infoid'>";
                   
                    $htmlStr .= sprintf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>", 
					"<input type='checkbox' name='InfoDel[]' value='$infoid'>", $information->getInfoID(), $information->getBezeichnung(),  $information->getText(), $information->getErstellungsdatum(), $information->getGültigkeitsdatum(), $information->getBenutzerID());

               
	}
//$htmlStr .= "</table>";
                    // Daten des Models eintragen
                    $form->setValue("[htmlStr]", $htmlStr);
                    
              
		return $form->__toString();
}
}
