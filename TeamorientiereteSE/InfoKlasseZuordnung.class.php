<?php
require_once 'InfoSQL.class.php';
class InfoKlasseZuordnung {

    private $submitKey = 'infoKlasse';
    private $submitKey2 = "GesamteSchule2";
    private $infoId;
    private $statusText;
    public function doActions() {
        
        // Prüfen ob das Formular dieser Sicht übergeben wurde
        if (array_key_exists($this->submitKey, $_REQUEST)) {
           
            $infoid = $_REQUEST['infoid'];
            $_REQUEST['infoid'] = $infoid;


            if (isset($_REQUEST['Auswahl'])) {
                reset($_REQUEST['Auswahl']);
                $i = 0;
                $klasse = "";
                foreach ($_REQUEST['Auswahl'] as $k => $v) {
                    //$k: Stelle im Array (beginnend mit 0); 
                    //$v: Value an der Stelle --> KindId zum Löschen des Kindes


                    $infosql = new InfoSQL();

                    if($infosql->infoKlasseZuordnen($infoid, $v))
                    {
                        $this->statusText="Termin wurde für ausgewählte Klassen angelegt";
                    }
                }
            } else {
                
                $i = 0;
                $contentId = "klasse_info";
                $this->statusText = "Sie haben keine Klasse ausgewählt!";
                print $this->__toString();
            }
        }
        if (array_key_exists($this->submitKey2, $_REQUEST)) {
            
            $infoid = $_REQUEST['infoid'];
            $_REQUEST['infoid'] = $infoid;
            $infosql = new InfoSQL();
            $klassenid = 'null';
            if($infosql->infoKlasseZuordnen($infoid, $klassenid))
            {
                $this->statusText = "Information wurde erfolgreich als Schultermin angelegt.";
            }
        }
    }

    /**
     * Meldungspuffer dieser Sicht; gibt die heir entstanden Meldungen zurück
     */
    public function getStatusText() {
        return $this->statusText;
    }

    /**
     * Gibt die textuelle (HTML) Repräsentation des Objekt zurück
     */
    public function __toString() {
        $klassenUeberblick = new KlassenUeberblick();
        $form = new Template("InfoKlasseZuordnung.tmpl.html");
        $form->setValue('[infoid]', $_REQUEST['infoid']);
        $form->setValue('[htmlStr]', $klassenUeberblick->__toString());
        return $form->__toString();
    }

}



