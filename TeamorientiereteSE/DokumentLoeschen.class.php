<?php

require_once("Dokument.class.php");

class DokumentLoeschen {
	
	public static $CONTENT_ID = "SchuelerLoeschen";
	private $submitKey = "dokument_loeschen"; 
	private $statusTxt;
	private $dokumente;
	
	
	public function doActions() {
$this->statusTxt = "";

		// Prüfen ob das Formular dieser Sicht übergeben wurde
		if (array_key_exists($this->submitKey, $_POST)) {
		
		$dokument = new Dokument();
		$this->dokumente = $_REQUEST["dokumente"];
		
		$dokdelete = explode(",", $this->dokumente);

			for ($i=0; $i < $_REQUEST["anzahl"]; $i++) 
			
				{
                    $v=$dokdelete[$i];
					
					$dokument->dokLoeschen($v);
				}
			$this->statusTxt .= "Ausgewählte Dokumente wurden erfolgreich gelöscht";
		} 
		
					
                    
                            
                	
	}


    public function getStatusText()
	{
	return $this->statusTxt;
	}
	
	public function __toString() {		
                    $form = new Template("ZustimmungDokument.tmpl.html"); 
				$form->setValue("[anzahl]", $_REQUEST["anzahl"]);
				$form->setValue("[dokumente]", $_REQUEST["dokumente"]);
				
                return $form->__toString();
        }

}