<?php

require_once("SchuelerListe.class.php");


class SchuelerUeberblickLoeschen {
	
	public static $CONTENT_ID = "SchuelerUeberblickLoeschen";
	private $submitKey = "schueler_auswaehlen";
	private $schuelerListe;
        public $checkbox;
        public $i;
	public $kinder;
	public $statusTxt;
	
	public function __construct() {
		$this->schuelerListe = new SchuelerListe();
	}
	public function getStatusText()
	{
	return $this->statusTxt;
	}
	public function doActions() {
$this->kinder = array(); 
//array_push($this->kinder, $kind);
		// Prüfen ob das Formular dieser Sicht übergeben wurde
		if (array_key_exists($this->submitKey, $_REQUEST)) {
		
		if (isset($_REQUEST['KindDel'])) 
		{
			reset($_REQUEST['KindDel']);
			$i=0;
			$kind="";
			foreach ($_REQUEST['KindDel'] as $k => $v) 
			//$k: Stelle im Array (beginnend mit 0); 
			//$v: Value an der Stelle --> KindId zum Löschen des Kindes
				{
					if ($i==0) {
					$kind .= $v;
					}
					else {
					$kind .= "," .$v;
					}
					$i++;
				}
			$_REQUEST['anzahl']=$i;
			//$_REQUEST['kindarr[]']=$_REQUEST['KindDel'];
			$_REQUEST['kinder']= $kind;
		$schuelerLoeschen = new SchuelerLoeschen();
		print $schuelerLoeschen->__toString();	
		} 
		else 
		{
			$i=0;
			$contentId="schueler_loeschen";
			$this->statusTxt = "Sie haben keine Schüler ausgewählt!";
			return $this->__toString();
		}
		                           
                }	
	}

	public function __toString() {
                $i = 0;
				$checkbox ="";
					$htmlStr ="";
					
		foreach ($this->schuelerListe->getSchueler() as $schueler) {
					//$link = sprintf("<a href='index.php?contentId=lehrer_aendern &id=%s'>%s</a>", $lehrer, $lehrer);
                    $form = new Template("SchuelerUeberblickLoeschen.tmpl.html"); 
                    $kindid = $schueler->getKindId();
                    $checkbox .= "<input type='checkbox' name='KindDel[]' value='$kindid'>";
                   
                    $htmlStr .= sprintf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>", 
					"<input type='checkbox' name='KindDel[]' value='$kindid'>", $schueler->getName(), $schueler->getVorname(), $schueler->getGeburtsdatum(), $schueler->getJahrgangsstufe(), $schueler->getStrasse(), $schueler->getPLZ(), $schueler->getOrt());

                    // Daten des Models eintragen
                    $form->setValue("[htmlStr]", $htmlStr);
                    $form->setValue("[checkbox]", $checkbox);
				
                }
			
                // erstelltes Formular zurück geben
            return $form->__toString();
        }

}