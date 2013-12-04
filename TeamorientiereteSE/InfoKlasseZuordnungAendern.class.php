<?php
require_once 'InfoSQL.class.php';
require_once ("KlassenUeberblickInfoAendern.class.php");
class InfoKlasseZuordnungAendern {

    private $submitKey = 'infoKlasseAendern';
    private $submitKey2 = "GesamteSchuleAendernInfo";
    private $infoId;

    public function doActions() {
        
        // Prüfen ob das Formular dieser Sicht übergeben wurde
        
        if (array_key_exists($this->submitKey, $_POST)) {
         
            $infosql = new InfoSQL();
          
            $infoid = $_REQUEST['infoid'];
            $_REQUEST['infoid'] = $infoid;
            

            if (isset($_REQUEST['InfoKlasse'])) {
                
                reset($_REQUEST['InfoKlasse']);
                $i = 0;
                $klasse = "";
                $infosql = new InfoSQL();
                $infosql->deleteInfoKlasseZuordnung($infoid);
                foreach ($_REQUEST['InfoKlasse'] as $k => $v) {
                    //$k: Stelle im Array (beginnend mit 0); 
                    //$v: Value an der Stelle --> KindId zum Löschen des Kindes


                    
                    $infosql->infoKlasseZuordnen($infoid, $v);
                }
            } else {
                
                $i = 0;
                $contentId = "klasse_info_aendern";
                $this->statusTxt = "Sie haben keine Klasse ausgewählt!";
                print $this->__toString();
            }
        }
        if (array_key_exists($this->submitKey2, $_REQUEST)) {
            
            
            $infoid = $_REQUEST['infoid'];
            $_REQUEST['infoid'] = $infoid;
            $infosql = new InfoSQL();
             $infosql->deleteInfoKlasseZuordnung($infoid);
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
        $klassenUeberblickAendern = new KlassenUeberblickInfoAendern();
        $form = new Template("InfoKlasseZuordnungAendern.tmpl.html");
        $form->setValue('[infoid]', $_REQUEST['infoid']);
        $form->setValue('[htmlStr]', $klassenUeberblickAendern->__toString());
        //print $klassenUeberblickAendern->__toString();
        return $form->__toString();
    }

}


