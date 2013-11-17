<?php
    require_once 'LehrerSQL.class.php';


/**
 * Description of Verwaltung
 In dieser Klasse wird das Anlegen, Ändern und Löschen von Admins behandelt
 
 * @author Basti
 */
class SchuelerAnlegen {
    
    private $submitKey = "schueler_anlegen_bestaetigen";
    private $statusText;
        
        public function setElternID($elternID) {
            $this->elternID = $elternID;
        }
        
        public function getElternID() {
            return $this->elternID;
        }
        
    	public function doActions() {
            
		if (array_key_exists($this->submitKey, $_POST)) {
                    
                    $zugangsschluessel = $this->generateRandomString();
                    $name = $_POST['name'];
                    $vorname = $_POST['vorname'];
                    $geburtsdatum = $_POST['geburtsdatum'];
                    $strasse = $_POST['strasse'];
                    $plz = $_POST['plz'];
                    $ort = $_POST['ort'];
                    $jahrgangsstufe = $_POST['jahrgangsstufe'];
                    $klasse = $_POST['jahrgangsstufe'];  
                    $benutzerID = $_POST['lehrerID'];  
                    
                    
                    $verwaltungSQL = new VerwaltungSQL();
                    $verwaltungSQL->schuelerAnlegen($zugangsschluessel, $name, $vorname, $geburtsdatum, $strasse, $plz, $ort, $jahrgangsstufe, $klasse, $benutzerID);
                    
		}
               
	}
        
	public function getStatusText() {
		return $this->statusText;
	}	
        
        
        function generateRandomString($length = 10) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, strlen($characters) - 1)];
                }
            return $randomString;
         }

	public function __toString() {
                $form = new Template("SchuelerAnlegen.tmpl.html");
                $form->setValue("[elternID]", $this->getElternID());
		
		return $form->__toString();
				
	}
}
