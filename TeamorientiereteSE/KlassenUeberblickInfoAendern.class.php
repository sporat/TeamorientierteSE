<?php

require_once("Klassenliste.class.php");
require_once("Klasse.class.php");
require_once ("InfoSQL.class.php");

class KlassenUeberblickInfoAendern {
	
	
	
	private $klassenListe;
        
	
	public function __construct() {
		$this->klassenListe = new KlassenListe();
	}
	
	public function __toString() {
            $infoid = $_POST["infoid"];
            
                $htmlStr ="";
		$checkbox = "";
		$htmlStr .= "<h3>Wählen Sie aus der unteren Liste betroffene Klassen aus</h3>";
		$htmlStr .= "<tr><th>KlassenID</th><th>Jahrgangstufe</th><th>Bezeichung</th><th>Betroffen?</th></tr>";
		$infosql = new InfoSQL();
                if ($infosql->existsSchulinfo($infoid)) {
                    
		foreach ($this->klassenListe->getKlasse() as $klasse) {
                                  
                     $klassenid= $klasse->getKlassenId();
                     $checkbox .= "<input type='checkbox' name='Auswahl[]' value= '$klassenid'>";                      
                     $htmlStr .= sprintf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>", $klasse->getKlassenId(), $klasse->getJahrgangsstufe(), $klasse->getBezeichnung(),"<input type='checkbox' name='InfoKlasse[]' value='$klassenid' checked='checked'>");	
	}
                }
              else 
                  
            {
            foreach ($this->klassenListe->getKlasse() as $klasse)
                {
                  $klassenid = $klasse->getKlassenId();
            
           // $checkbox .= "<input type='checkbox' name='Auswahl[]' value= '$klassenid' checked>";
            if ($infosql->infoKlasseCheck($infoid, $klassenid)) 
                {
                $htmlStr .= sprintf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>", $klasse->getKlassenId(), $klasse->getJahrgangsstufe(), $klasse->getBezeichnung(), "<input type='checkbox' name='InfoKlasse[]' value='$klassenid' checked='checked'>");
            } 
            else 
                {
                $htmlStr .= sprintf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>", $klasse->getKlassenId(), $klasse->getJahrgangsstufe(), $klasse->getBezeichnung(), "<input type='checkbox' name='InfoKlasse[]' value='$klassenid' >");
            }
        }
                
        
    }
    return $htmlStr;
    }
        }
                

