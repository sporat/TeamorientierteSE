<?php
require_once 'TerminSQL.class.php';
require_once ("KlassenUeberblickTerminAendern.class.php");
class TerminKlasseZuordnungAendern {

    private $submitKey = 'terminKlasseAendern';
    private $submitKey2 = "GesamteSchuleAendern";
    private $terminId;

    public function doActions() {
        
        // Prüfen ob das Formular dieser Sicht übergeben wurde
        
        if (array_key_exists($this->submitKey, $_POST)) {
         
            $terminsql = new TerminSQL();
          
            $terminid = $_REQUEST['terminid'];
            $_REQUEST['terminid'] = $terminid;
            

            if (isset($_REQUEST['AuswahlA'])) {
                
                reset($_REQUEST['AuswahlA']);
                $i = 0;
                $klasse = "";
                $terminsql = new TerminSQL();
                $terminsql->deleteTerminKlasseZuordnung($terminid);
                foreach ($_REQUEST['AuswahlA'] as $k => $v) {
                    //$k: Stelle im Array (beginnend mit 0); 
                    //$v: Value an der Stelle --> KindId zum Löschen des Kindes


                    
                    $terminsql->terminKlasseZuordnen($terminid, $v);
                }
            } else {
                
                $i = 0;
                $contentId = "klasse_termin_aendern";
                $this->statusTxt = "Sie haben keine Klasse ausgewählt!";
                print $this->__toString();
            }
        }
        if (array_key_exists($this->submitKey2, $_REQUEST)) {
            
            
            $terminid = $_REQUEST['terminid'];
            $_REQUEST['terminid'] = $terminid;
            $terminsql = new TerminSQL();
             $terminsql->deleteTerminKlasseZuordnung($terminid);
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
        $klassenUeberblickAendern = new KlassenUeberblickTerminAendern();
        $form = new Template("TerminKlasseZuordnungAendern.tmpl.html");
        $form->setValue('[terminid]', $_REQUEST['terminid']);
        $form->setValue('[htmlStr]', $klassenUeberblickAendern->__toString());
        return $form->__toString();
    }

}
