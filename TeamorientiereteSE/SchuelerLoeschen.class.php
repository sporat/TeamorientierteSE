<?php

require_once("SchuelerSQL.class.php");

class SchuelerLoeschen {
	
	public static $CONTENT_ID = "SchuelerLoeschen";
	private $submitKey = "schueler_loeschen"; 
	private $formular;
	private $statusTxt;
	private $kinder;
	
	
	public function doActions() {
$statusTxt = "";

		// Prüfen ob das Formular dieser Sicht übergeben wurde
		if (array_key_exists("schueler_loeschen", $_POST)) {
		
		$schuelerSQL = new SchuelerSQL();
		$this->kinder = $_REQUEST["kinder"];
		
		$kinddelete = explode(",", $this->kinder);

			for ($i=0; $i < $_REQUEST["anzahl"]; $i++) 
			
				{
                    $v=$kinddelete[$i];
					
					$schuelerSQL->SchuelerLoeschen($v);
				}
			$this->statusTxt .= "Ausgewählte Schüler wurden erfolgreich gelöscht";
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
                    $form = new Template("Zustimmung.tmpl.html"); 
				$form->setValue("[Anz]", $_REQUEST["anzahl"]);
				$form->setValue("[Kind]", $_REQUEST["kinder"]);
				$form->setValue("[anzahl]", $_REQUEST["anzahl"]);
				$form->setValue("[kinder]", $_REQUEST["kinder"]);
                return $form->__toString();
        }

}