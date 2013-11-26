<?php
    require_once 'TerminSQL.class.php';
    require_once ("KlassenUeberblick.class.php");


/**
 * Description of Verwaltung
 In dieser Klasse wird das Anlegen, Ändern und Löschen von Admins behandelt
 
 * @author Basti
 */
class TerminAnlegen {
    
    private $submitKey = "termin_anlegen";
    private $statusText;
        
     
        
    	public function doActions() {
            
		if (array_key_exists($this->submitKey, $_POST)) {
                    
                    
                    $beschreibung = $_POST['textfeld'];
                    $ort= $_POST['ort'];
                    $infoschreiben =$_POST['infoschreiben'];
                    $verantwortlicher = $_POST['verantwortlicher']; 
                    $benutzernummer = User::getInstance()->getBenutzerId();
                    $zeit= $_POST['zeit'];
                    $datum = $_POST['datum'];
                    
                    
                    $terminSQL = new TerminSQL();
                    $_REQUEST['terminid']=$terminSQL->anlegen($beschreibung, $ort, $infoschreiben, $verantwortlicher, $benutzernummer, $datum,$zeit);
                    
		}
               
	}
        
	public function getStatusText() {
		return $this->statusText;
	}	
        
        
      
         

	public function __toString() {
            
                $form = new Template("Terminanlegen.tmpl.html");
                  
		
		return $form->__toString();
				
	}
}
