<?php

require_once("DokumentListe.class.php");

class DokumentUeberblick {
	
	public static $CONTENT_ID = "FachOutline";
	
	private $dokumentListe;
        
	
	public function __construct() {
		$this->dokumentListe = new DokumentListe();
	}
	
	public function __toString() {

		$htmlStr = "<table border='1'>";
		$htmlStr .= "<h3>Wählen Sie aus der unteren Liste das Dokument aus, das Sie herunterladen wollen</h3>";
		$htmlStr .= "<tr><th>Dateiname</th><th>hochgestellt von</th><th>Fach</th><th>Dateivorschau</th></tr>";
		
		foreach ($this->dokumentListe->getDokument() as $dokument) {
                   $linkAnsehen = sprintf("<a href='uploads/%s'>Datei ansehen</a>", $dokument->getDateiname());
                   $link = sprintf("<a href='index.php?contentId=dokument_herunterladen_formular&id=%s&name=%s'>%s</a>", $dokument->getDokumentID(), $dokument->getDateiname(), $dokument->getDateiname());                        
		if ($dokument->getFachID()==null)
                {
                    $fachbez = "allgemeines Dokument";
                }
                else
                {
                    $fach = new Fach();
                    $fach->laden($dokument->getFachID());
                    $fachbez = $fach->getBezeichnung();
                }
                $user = new User();
                $erstellt_von = $user->getNameForId($dokument->getBenutzerID());
                
                        $htmlStr .= sprintf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>", 
				$link, $erstellt_von, $fachbez, $linkAnsehen);

                }
		
		$htmlStr .= "</table>";
		return $htmlStr;
	}

}