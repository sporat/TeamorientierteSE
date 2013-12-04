<?php

require_once("ElternKinderListe.class.php");

class ElternKinderUeberblick {
	
	public static $CONTENT_ID = "UserOutline";
	
	private $kinderListe;
        private $kind;
	
	public function __construct() {
		$this->kinderListe = new ElternKinderListe();
	}
	public function doActions() {
            if (array_key_exists("kindid", $_REQUEST)) {
			// Model instanziieren und laden
			$this->kind = new Schueler();
			$this->kind->laden($_REQUEST["kindid"]);
                        
                        
		}
        }
	public function __toString() {

		$htmlStr = "";
		$htmlStr .= "<h3>Wählen Sie das Kind aus, für welches Sie die Noten einsehen wollen</h3>";
				
		foreach ($this->kinderListe->getKind() as $kind) {
			$htmlStr .= sprintf("<a href='index.php?contentId=noten_einsehen&kindid=%s'>%s</a>", $kind->getKindId(), $kind->getVorname());                        
			$htmlStr .= sprintf("<br>"); 
                }
		
		return $htmlStr;
	}

}