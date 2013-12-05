<?php

require_once("InfoBenutzerListe.class.php");

class InfoBenutzerUeberblick {
	
	public static $CONTENT_ID = "information_aendern_formular";
	
	private $infoListe;
        
	
	public function __construct() {
            if (User::getInstance()->getRole()=="Verwaltung")
            {
                $this->infoListe = new InfoListe();
            }
        else {
             $this->infoListe = new InfoBenutzerListe();
     
             }
		
	}
	
	public function __toString() {

		$htmlStr = "<table border='1'>";
		$htmlStr .= "<h3>Wählen Sie aus der unteren Liste die Information aus, den Sie ändern wollen</h3>";
		$htmlStr .= "<tr><th>InfoID</th><th>Bezeichnung</th><th>Gültigkeitsdatum</th><th>Text</th></tr>";
		
		foreach ($this->infoListe->getInfo() as $information) {
			$link = sprintf("<a href='index.php?contentId=information_aendern_formular&id=%s'>%s</a>", $information->getInfoId(), $information->getInfoId());                        
			$htmlStr .= sprintf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>", 
				$link, $information->getBezeichnung(), $information->getGültigkeitsdatum(), $information->getText());

                }
		
		$htmlStr .= "</table>";
       
		return $htmlStr;
	}

}

