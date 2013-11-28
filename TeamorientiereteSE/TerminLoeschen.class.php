<?php

require_once("TerminSQL.class.php");

class TerminLoeschen {
	
	public static $CONTENT_ID = "TerminLoeschen";
	private $submitKey = "termin_loeschen"; 
	private $formular;
	private $statusTxt;
	private $termin;
	
	
	public function doActions() {
$statusTxt = "";

		// Prüfen ob das Formular dieser Sicht übergeben wurde
		if (array_key_exists("termin_loeschen", $_POST)) {
		
		$terminSQL = new TerminSQL();
		$this->termin = $_REQUEST["termin"];
		
		$termindelete = explode(",", $this->termin);

			for ($i=0; $i < $_REQUEST["anzahl"]; $i++) 
			
				{
                    $v=$termindelete[$i];
					
					$terminSQL->TerminLoeschen($v);
                                        $terminSQL->deleteTerminKlasseZuordnung($v);
				}
			$this->statusTxt .= "Ausgewählte Termine wurden erfolgreich gelöscht";
		} 
		
					
                    
                            
                	
	}


    public function getStatusText()
	{
	return $this->statusTxt;
	}
	
	public function getFormular()
	{
		return $this->formular;
	}
	public function __toString() {		
                    $form = new Template("ZustimmungTermin.tmpl.html"); 
				$form->setValue("[Anz]", $_REQUEST["anzahl"]);
				$form->setValue("[termin]", $_REQUEST["termin"]);
				$form->setValue("[anzahl]", $_REQUEST["anzahl"]);
				$form->setValue("[termin]", $_REQUEST["termin"]);
                return $form->__toString();
        }

}