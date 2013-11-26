<?php
    require_once 'FachSQL.class.php';


/**
 * Description of Verwaltung
 In dieser Klasse wird das Anlegen, Ändern und Löschen von Admins behandelt
 
 * @author Basti
 */
class FachAnlegen {
    
    private $submitKey = "fach_anlegen_bestaetigen";
    private $statusText;
    private $fachID; 
        public function setFachID($fachID) {
            $this->fachID = $fachID;
        }
        
        public function getFachID() {
            return $this->fachID;
        }
        
    	public function doActions() {
            
		if (array_key_exists($this->submitKey, $_POST)) {
                    
               
                    $bezeichnung = $_POST['bezeichnung'];
                    
                    $fachSQL = new FachSQL();
                    if($fachSQL->anlegen($bezeichnung)) 
					{
					$this->statusText = "Fach (".$bezeichnung.") wurde erfolgreich angelegt.";
					}
					else
					{
					$this->statusText = "Fach (".$bezeichnung.") konnte nicht angelegt werden, weil es schon vorhanden ist.";
                    }
		}
               
	}
        
	public function getStatusText() {
		return $this->statusText;
	}	
        
        

	public function __toString() {
                $form = new Template("FachAnlegen.tmpl.html");
		
		return $form->__toString();
				
	}
}
