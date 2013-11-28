<?php
    require_once 'TerminSQL.class.php';
    require_once ("KlassenUeberblick.class.php");
    require_once ("Termin.class.php");


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
    private $termin;
    private $terminid;
     
        
    	public function doActions() {
            
		if (array_key_exists($this->submitKey, $_POST)) {
                    
                    
                    $this->beschreibung = $_POST['textfeld'];
                    $this->ort= $_POST['ort'];
                    $this->infoschreiben =$_POST['infoschreiben'];
                    $this->verantwortlicher = $_POST['verantwortlicher']; 
                    $this->benutzernummer = User::getInstance()->getBenutzerId();
                    $this->zeit= $_POST['zeit'];
                    $this->datum = $_POST['datum'];
                    $this->terminid = $_POST['terminid'];
                    
                    
                    
                    $this->termin= new Termin();
                    $terminSQL = new TerminSQL();
                    
                    $terminSQL->aendern($this->beschreibung, $this->ort, $this->infoschreiben, $this->verantwortlicher, $this->benutzernummer, $this->datum, $this->zeit, $this->terminid);
                    $_REQUEST['contentId']='termin_aendern_klasse';
		}
                elseif (array_key_exists("id", $_REQUEST)) {
			// Model instanziieren und laden
			$this->termin = new Termin();
			$this->termin->laden($_REQUEST["id"]);
                        $this->terminid=$_REQUEST["id"];
                        
                       
		}
               
	}
        
	public function getStatusText() {
		return $this->statusText;
	}	
        
        
      
        

	public function __toString() {
            
                $form = new Template("TerminAendern.tmpl.html");
                  
		
                $form->setValue('[ort]', $this->termin->getOrt());
                print $this->termin->getOrt();
                $form->setValue("[datum]", $this->termin->getDatum() );
                $form->setValue("[zeit]", $this->termin->getZeit());
                $form->setValue("[verantwortlicher]", $this->termin->getVerantwortlicher());
                if ($this->termin->getInfoschreiben()==0){
                    $form->setValue("selected0",'selected'); 
                    }
                else{
                    $form->setValue("selected1",'selected'); 
                    }
                    $form->setValue('leer', $this->termin->getBeschreibung());
                    $form->setValue('[terminid]', $this->terminid);
		return $form->__toString();
				
		
	}

}
