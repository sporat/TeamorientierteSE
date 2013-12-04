<?php

require_once("DokumentListe.class.php");


class DokumentUeberblickLoeschen {
	
	private $submitKey = "dokument_auswaehlen";
	private $dokumentListe;
        public $i;
	public $kinder;
	public $statusTxt;
	
	public function __construct() {
		$this->dokumentListe = new DokumentListe();
	}
	public function getStatusText()
	{
	return $this->statusTxt;
	}
	public function doActions() {

		// Prüfen ob das Formular dieser Sicht übergeben wurde
		if (array_key_exists($this->submitKey, $_REQUEST)) {
		
		if (isset($_REQUEST['DokDel'])) 
		{
			reset($_REQUEST['DokDel']);
			$i=0;
			$dok="";
			foreach ($_REQUEST['DokDel'] as $k => $v) 
			//$k: Stelle im Array (beginnend mit 0); 
			//$v: Value an der Stelle --> KindId zum Löschen des Kindes
				{
					if ($i==0) {
					$dok .= $v;
					}
					else {
					$dok .= "," .$v;
					}
					$i++;
				}
			$_REQUEST['anzahl']=$i;
			$_REQUEST['dokumente']= $dok;
		$_REQUEST['contentId']="dok_del";	
		} 
		else 
		{
			$i=0;
			$_POST['contentId']="dokumente_loeschen";
			$this->statusTxt = "Sie haben keine Dokumente ausgewählt!";
			return $this->__toString();
		}
		                           
                }	
	}

	public function __toString() {
		
		   $htmlStr ="";
					
		foreach ($this->dokumentListe->getDokument() as $dokument) {
					
                    $form = new Template("DokumentUeberblickLoeschen.tmpl.html"); 
                    $dokumentid = $dokument->getDokumentID();
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
					"<input type='checkbox' name='DokDel[]' value='$dokumentid'>", $erstellt_von, $fachbez, $dokument->getDateiname());

                    // Daten des Models eintragen
                    $form->setValue("[htmlStr]", $htmlStr);
                    				
                }
			
                // erstelltes Formular zurück geben
            return $form->__toString();
        }

}