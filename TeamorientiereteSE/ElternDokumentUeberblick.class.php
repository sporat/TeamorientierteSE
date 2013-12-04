<?php

require_once("ElternDokumentListe.class.php");
require_once ("AllgemeineDokumentListe.class.php");

class ElternDokumentUeberblick {
	
	public static $CONTENT_ID = "FachOutline";
	
	private $dokumentListe;
        private $allgemeineDokumentListe;
        
        public function __construct() {
    $this->dokumentListe = new ElternDokumentListe();
    $this->allgemeineDokumentListe = new AllgemeineDokumentListe();
}
	
	public function __toString() {
            
$form = new Template ("ElternDokumentUeberblick.tmpl.html");
		$htmlStr = "";
                $str = "";
//Dokumente herunterladen momentan über den Vorschau-Link von $linkAnsehen;  
		foreach ($this->dokumentListe->getElternDokument() as $dokument) {
                   $linkAnsehen = sprintf("<a href='uploads/%s'>Datei herunterladen</a>", $dokument->getDateiname());
                   $link = sprintf("<a href='index.php?contentId=dokument_herunterladen_formular&id=%s&name=%s'>%s</a>", $dokument->getDokumentID(), $dokument->getDateiname(), $dokument->getDateiname());                        
		
                $user = new User();
                $erstellt_von = $user->getNameForId($dokument->getDokumentBenutzerID());
                
                        $htmlStr .= sprintf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>", 
				$dokument->getKindVorname(), $dokument->getBezeichnung(), $dokument->getDateiname(), $erstellt_von, $linkAnsehen);

                }
                foreach ($this->allgemeineDokumentListe->getAllgemeinesDokument() as $allgemeinesDokument) {
                   $linkAllg = sprintf("<a href='uploads/%s'>Datei herunterladen</a>", $allgemeinesDokument->getDateiname());
                   $link = sprintf("<a href='index.php?contentId=dokument_herunterladen_formular&id=%s&name=%s'>%s</a>", $allgemeinesDokument->getDokumentID(), $allgemeinesDokument->getDateiname(), $allgemeinesDokument->getDateiname());                        
		
                $user = new User();
                $erstellt_von = $user->getNameForId($allgemeinesDokument->getDokumentBenutzerID());
                
                        $str .= sprintf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>", 
				$allgemeinesDokument->getKindVorname(), $allgemeinesDokument->getBezeichnung(), $allgemeinesDokument->getDateiname(), $erstellt_von, $linkAllg);

                }
                
		foreach ($this->allgemeineDokumentListe->getDokumentOhneFach() as $ohnefachDok) {
                   $linkAllg = sprintf("<a href='uploads/%s'>Datei herunterladen</a>", $ohnefachDok->getDateiname());
                   $link = sprintf("<a href='index.php?contentId=dokument_herunterladen_formular&id=%s&name=%s'>%s</a>", $ohnefachDok->getDokumentID(), $ohnefachDok->getDateiname(), $ohnefachDok->getDateiname());                        
		
                $user = new User();
                $erstellt_von = $user->getNameForId($ohnefachDok->getDokumentBenutzerID());
                
                        $str .= sprintf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>", 
				$ohnefachDok->getKindVorname(), $ohnefachDok->getBezeichnung(), $ohnefachDok->getDateiname(), $erstellt_von, $linkAllg);

                }
                
                foreach ($this->allgemeineDokumentListe->getDokumentOhneKlasse() as $ohneklasseDok) {
                   $linkAllg = sprintf("<a href='uploads/%s'>Datei herunterladen</a>", $ohneklasseDok->getDateiname());
                   $link = sprintf("<a href='index.php?contentId=dokument_herunterladen_formular&id=%s&name=%s'>%s</a>", $ohneklasseDok->getDokumentID(), $ohneklasseDok->getDateiname(), $ohneklasseDok->getDateiname());                        
		
                $user = new User();
                $erstellt_von = $user->getNameForId($ohneklasseDok->getDokumentBenutzerID());
                
                        $str .= sprintf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>", 
				$ohneklasseDok->getKindVorname(), $ohneklasseDok->getBezeichnung(), $ohneklasseDok->getDateiname(), $erstellt_von, $linkAllg);

                }
                
		$form->setValue("[htmlStr]", $htmlStr);
                $form->setValue("[str]", $str);
		return $form->__toString();
	}

}