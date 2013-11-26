<?php
    require_once 'InfoSQL.class.php';

class InfoAnlegen {
    
    private $submitKey = "InfoAnlegen";
    private $statusText;
	private $infoID;
        
        public function setInfoID($infoID) {
            $this->infoID = $infoID;
        }
        
        public function getInfoID() {
            return $this->infoID;
        }
        
    	public function doActions() {
            
		if (array_key_exists($this->submitKey, $_POST)) {
                   
                    $gültigkeitsdatum = $_POST['gültigkeitsdatum'];
                    $textfeld = $_POST['textfeld'];
                    $bezeichnung = $_POST['bezeichnung'];
                    $benutzerID = User::getInstance()->getBenutzerId();  
                    
                    
                    $infoSQL = new InfoSQL();
                    if($infoSQL->anlegen($gültigkeitsdatum, $textfeld, $bezeichnung, $benutzerID))
					{
					$this->statusText= "Information '".$bezeichnung."' wurde für den '".$gültigkeitsdatum."' angelegt.";
					}
                    
		}
               
	}
        
	public function getStatusText() {
		return $this->statusText;
	}	
        
        
        

	public function __toString() {
                $form = new Template("InfoAnlegen.tmpl.html");
				$form->setValue("[benutzerID]", User::getInstance()->getBenutzerId());
				$form->setValue("[contentId]", "");
		return $form->__toString();
				
	}
}
