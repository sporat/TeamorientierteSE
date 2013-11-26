<?php

require_once("ElternListe.class.php");

class ElternUeberblick {
	
	public static $CONTENT_ID = "ElternUeberblick";
	private $contentID;
	private $elternListe;
        
	
	public function __construct() {
		$this->elternListe = new ElternListe();
	}
	
        public function setContentID($contentID) {
            $this->contentID = $contentID;
        }
        
        public function getContentID() {
            return $this->contentID;
        }
        
	public function __toString() {
                $cID = $this->getContentID();
		$htmlStr = "<table border='1'>";
		$htmlStr .= "<h3>Wählen Sie aus der unteren Liste die Eltern, die sie ändern wollen, aus:</h3>";
		$htmlStr .= "<tr><th>ElternID</th><th>Benutzername</th><th>Vorname</th><th>Nachname</th><th>E-Mail</th><th>Telefon</th><th>Mitteilungsweg</th></tr>";
		
		foreach ($this->elternListe->getEltern() as $eltern) {
			$link = sprintf("<a href='index.php?contentId=eltern_aendern&id=%s'>%s</a>", $eltern, $eltern);    
				                     
			$htmlStr .= sprintf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>", 
				$link, $eltern->getBenutzername(), $eltern->getVorname(), $eltern->getName(), $eltern->getEmail(), $eltern->getTelefon(), $eltern->getMitteilungsweg());

                }
		
		$htmlStr .= "</table>";
                
		return $htmlStr;
	}

}