<?php

require_once("InfoSQL.class.php");

class InfoLoeschen {
	
	public static $CONTENT_ID = "InfoLoeschen";
	private $submitKey = "info_loeschen"; 
	private $formular;
	private $statusTxt;
	private $info;
	
	
	public function doActions() {
$statusTxt = "";

		// Prüfen ob das Formular dieser Sicht übergeben wurde
		if (array_key_exists("info_loeschen", $_POST)) {
		
		$infoSQL = new InfoSQL();
		$this->info = $_REQUEST["info"];
		
		$infodelete = explode(",", $this->info);

			for ($i=0; $i < $_REQUEST["anzahl"]; $i++) 
			
				{
                    $v=$infodelete[$i];
					print $v;
					$infoSQL->infoLoeschen($v);
                                        $infoSQL->deleteInfoKlasseZuordnung($v);
				}
			$this->statusTxt .= "Ausgewählte Informationen wurden erfolgreich gelöscht";
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
                    $form = new Template("ZustimmungInfo.tmpl.html"); 
				$form->setValue("[Anz]", $_REQUEST["anzahl"]);
				$form->setValue("[Info]", $_REQUEST["info"]);
				$form->setValue("[anzahl]", $_REQUEST["anzahl"]);
				$form->setValue("[info]", $_REQUEST["info"]);
                return $form->__toString();
        }

}

