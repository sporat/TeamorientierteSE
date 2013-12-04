<?php

require_once("SchuelerOhneKlasseListe.class.php");
require_once("KlassenlehrerSQL.class.php");


class SchuelerOhneKlasseUeberblick{
	
	public static $CONTENT_ID = "SchuelerUeberblickZuordnen";
	private $submitKey = "schueler_zuordnen_auswaehlen";
	private $schuelerListe;
        public $checkbox;
        public $i;
	public $kinder;
	public $statusTxt;
        public $jahrgangsstufe;

        
	public function __construct() {
            if(User::getInstance()->getRole() == 'Klassenlehrer'){
                $klassenlehrerSQL = new KlassenlehrerSQL();
                
                $jahrgangsstufe = $klassenlehrerSQL->setKlassenlehrerJahrgangsstufe(User::getInstance()->getBenutzerId());
                $this->schuelerListe = new SchuelerOhneKlasseListe($jahrgangsstufe);
            }
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
                    $klassenlehrerSQL = new KlassenlehrerSQL();
                    $klasseID = $klassenlehrerSQL->setKlassenlehrerKlasse(User::getInstance()->getBenutzerId());
                    if (isset($_REQUEST['KindZuordnen'])) 
                    {
                            reset($_REQUEST['KindZuordnen']);
                            $i=0;
                            $kind="";
                            foreach ($_REQUEST['KindZuordnen'] as $k => $v) 
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
                                            $klassenlehrerSQL->SchuelerZuKlassezuordnen($v, $klasseID); 

                                    }
                            $_REQUEST['anzahl']=$i;
                            //$_REQUEST['kindarr[]']=$_REQUEST['KindZuordnen'];
                            $_REQUEST['kinder']= $kind;
                            //echo $_REQUEST['kinder'];

                    //$schuelerLoeschen = new SchuelerLoeschen();
                    //print $schuelerLoeschen->__toString();	
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
                    $form = new Template("SchuelerUeberblickZuordnen.tmpl.html"); 
                    $kindid = $schueler->getKindId();
                    $checkbox .= "<input type='checkbox' name='KindZuordnen[]' value='$kindid'>";
                   
                    $htmlStr .= sprintf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>", 
					"<input type='checkbox' name='KindZuordnen[]' value='$kindid'>", $schueler->getName(), $schueler->getVorname(), $schueler->getGeburtsdatum(), $schueler->getJahrgangsstufe(), $schueler->getStrasse(), $schueler->getPLZ(), $schueler->getOrt());

                    // Daten des Models eintragen
                    $form->setValue("[htmlStr]", $htmlStr);
                    $form->setValue("[checkbox]", $checkbox);
				
                }
			
                // erstelltes Formular zurück geben
            return $form->__toString();
        }

}