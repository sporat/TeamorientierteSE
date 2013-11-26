<?php

require_once("ElternSQL.class.php");

class ElternLoeschen {
	
	public static $CONTENT_ID = "ElternLoeschen";
	private $submitKey = "eltern_loeschen"; 
	private $formular;
	private $statusTxt;
	private $eltern;
	
	public function doActions() {
$statusTxt = "";

		// Prüfen ob das Formular dieser Sicht übergeben wurde
		if (array_key_exists("eltern_loeschen", $_POST)) {
		
		$elternSQL = new ElternSQL();
		$this->eltern = $_REQUEST["eltern"];
		
		$elterndelete = explode(",", $this->eltern);
//explode wandelt string in array um;
			for ($i=0; $i < $_REQUEST["anzahl"]; $i++) 
			
				{
                    $v=$elterndelete[$i];
					
					$elternSQL->elternLoeschen($v);
				}
			$this->statusTxt .= "Ausgewählte Eltern wurden erfolgreich gelöscht";
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
                    $form = new Template("ZustimmungEltern.tmpl.html"); 
				$form->setValue("[Anz]", $_REQUEST["anzahl"]);
				$form->setValue("[Eltern]", $_REQUEST["eltern"]);
				$form->setValue("[anzahl]", $_REQUEST["anzahl"]);
				$form->setValue("[eltern]", $_REQUEST["eltern"]);
                return $form->__toString();
        }

}