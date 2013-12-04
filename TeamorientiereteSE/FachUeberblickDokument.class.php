<?php

require_once("FachListe.class.php");

class FachUeberblickDokument {
	
	public static $CONTENT_ID = "FachOutline";
	
	private $fachListe;
        
	
	public function __construct() {
            $this->fachListe = new FachListe();  
	}
	
	public function __toString() {

		$str = "";
		
		foreach ($this->fachListe->getFach() as $fach) {
//$string .= $fach->getFachID(). $fach->getBezeichnung();                   
$str .= sprintf("<option value=".$fach->getFachID().">".$fach->getBezeichnung()."</option>");
         }
		
		return $str;
	}

}

