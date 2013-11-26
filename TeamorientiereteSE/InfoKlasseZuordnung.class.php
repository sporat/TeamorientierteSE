<?php
require_once 'InfoSQL.class.php';
class InfoKlasseZuordnung {

    private $submitKey = 'infoKlasse';
    private $submitKey2 = "GesamteSchule";
    private $infoId;

    public function doActions() {
        
        // Prüfen ob das Formular dieser Sicht übergeben wurde
        if (array_key_exists($this->submitKey, $_REQUEST)) {
           
            $terminid = $_REQUEST['infoid'];
            $_REQUEST['infoid'] = $infoid;


            if (isset($_REQUEST['Auswahl'])) {
                reset($_REQUEST['Auswahl']);
                $i = 0;
                $klasse = "";
                foreach ($_REQUEST['Auswahl'] as $k => $v) {
                    //$k: Stelle im Array (beginnend mit 0); 
                    //$v: Value an der Stelle --> KindId zum Löschen des Kindes


                    $infosql = new InfoSQL();

                    $infosql->infoKlasseZuordnen($infoid, $v);
                }
            } else {
                
                $i = 0;
                $contentId = "klasse_info";
                $this->statusTxt = "Sie haben keine Klasse ausgewählt!";
                print $this->__toString();
            }
        }
        if (array_key_exists($this->submitKey2, $_REQUEST)) {
            
            $infoid = $_REQUEST['infoid'];
            $_REQUEST['infoid'] = $infoid;
            $infosql = new InfoSQL();
            $klassenid = 'null';
            $infosql->infoKlasseZuordnen($infoid, $klassenid);
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


