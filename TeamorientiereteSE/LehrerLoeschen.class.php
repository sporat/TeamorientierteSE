<?php

require_once("LehrerSQL.class.php");

class LehrerLoeschen {
	
	public static $CONTENT_ID = "LehrerLoeschen";
	private $submitKey = "lehrer_loeschen"; 
	private $formular;
	private $statusTxt;
	private $lehrer;
	
	
	public function doActions() {
$statusTxt = "";

		// Prüfen ob das Formular dieser Sicht übergeben wurde
		if (array_key_exists("lehrer_loeschen", $_POST)) {
		
		$lehrerSQL = new LehrerSQL();
		$this->lehrer = $_REQUEST["lehrer"];
		
		$lehrdelete = explode(",", $this->lehrer);

			for ($i=0; $i < $_REQUEST["anzahl"]; $i++) 
			
				{
                    $v=$lehrdelete[$i];
					
					$lehrerSQL->lehrerLoeschen($v);
				}
			$this->statusTxt .= "Ausgewählte Lehrer wurden erfolgreich gelöscht";
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
                    $form = new Template("ZustimmungLehrer.tmpl.html"); 
				$form->setValue("[Anz]", $_REQUEST["anzahl"]);
				$form->setValue("[Lehrer]", $_REQUEST["lehrer"]);
				$form->setValue("[anzahl]", $_REQUEST["anzahl"]);
				$form->setValue("[lehrer]", $_REQUEST["lehrer"]);
                return $form->__toString();
        }

}