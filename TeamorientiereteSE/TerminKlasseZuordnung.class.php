<?php
require_once 'TerminSQL.class.php';
class TerminKlasseZuordnung {

    private $submitKey = 'terminKlasse';
    private $submitKey2 = "GesamteSchule";
    private $terminId;

    public function doActions() {
        
        // Prüfen ob das Formular dieser Sicht übergeben wurde
        if (array_key_exists($this->submitKey, $_REQUEST)) {
           
            $terminid = $_REQUEST['terminid'];
            $_REQUEST['terminid'] = $terminid;


            if (isset($_REQUEST['Auswahl'])) {
                reset($_REQUEST['Auswahl']);
                $i = 0;
                $klasse = "";
                foreach ($_REQUEST['Auswahl'] as $k => $v) {
                    //$k: Stelle im Array (beginnend mit 0); 
                    //$v: Value an der Stelle --> KindId zum Löschen des Kindes


                    $terminsql = new TerminSQL();

                    $terminsql->terminKlasseZuordnen($terminid, $v);
                }
            } else {
                
                $i = 0;
                $contentId = "klasse_termin";
                $this->statusTxt = "Sie haben keine Klasse ausgewählt!";
                print $this->__toString();
            }
        }
        if (array_key_exists($this->submitKey2, $_REQUEST)) {
            
            $terminid = $_REQUEST['terminid'];
            $_REQUEST['terminid'] = $terminid;
            $terminsql = new TerminSQL();
            $klassenid = 'null';
            $terminsql->terminKlasseZuordnen($terminid, $klassenid);
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
        $form = new Template("TerminKlasseZuordnung.tmpl.html");
        $form->setValue('[terminid]', $_REQUEST['terminid']);
        $form->setValue('[htmlStr]', $klassenUeberblick->__toString());
        return $form->__toString();
    }

}
