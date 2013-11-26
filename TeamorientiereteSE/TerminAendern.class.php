<?php
    require_once 'TerminSQL.class.php';
    require_once ("KlassenUeberblick.class.php");


/**
 * Description of Verwaltung
 In dieser Klasse wird das Anlegen, Ändern und Löschen von Admins behandelt
 
 * @author Basti
 */
class TerminAendern {
    
    private $submitKey = "termin_aendern";
    private $statusText;
    private $beschreibung;
    private $ort;
    private $infoschreiben;
    private $verantwortlicher;
    private $benutzernummer;
    private $datum;
    private $zeit;
        
     
        
    	public function doActions() {
            
		if (array_key_exists($this->submitKey, $_POST)) {
                    
                    
                    $this->beschreibung = $_POST['textfeld'];
                    $this->ort= $_POST['ort'];
                    $this->infoschreiben =$_POST['infoschreiben'];
                    $this->verantwortlicher = $_POST['verantwortlicher']; 
                    $this->benutzernummer = User::getInstance()->getBenutzerId();
                    $this->zeit= $_POST['zeit'];
                    $this->datum = $_POST['datum'];
                    
                    
                    
                    
                    $terminSQL = new TerminSQL();
                    $_REQUEST['terminid']=$terminSQL->aendern($beschreibung, $ort, $infoschreiben, $verantwortlicher, $benutzernummer, $datum,$zeit,$terminid);
                    
		}
               
	}
        
	public function getStatusText() {
		return $this->statusText;
	}	
        
        
      
         

	public function __toString() {
            
                $form = new Template("TerminAendern.tmpl.html");
                  $form->setValue($key, $value);
		$form->setValue($key, $value);
                          $form->setValue($key, $value);
                          $form->setValue($key, $value);
		return $form->__toString();
				
	}
}
