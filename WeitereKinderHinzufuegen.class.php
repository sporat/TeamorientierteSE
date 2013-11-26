<?php

require_once ("ElternSQL.class.php");
require_once ("SchuelerSQL.class.php");

/**
 * 


 * 
 */
class WeitereKinderHinzufuegen {

    private $submitKey = "weitere Kinder zuordnen";
    private $submitKey2 = "Zurueck";
    private $statusText;

    public function doActions() {
        
        $elternsql = new ElternSQL();
        
        if (array_key_exists("weitere Kinder zuordnen", $_POST)) {
            $zugangsschlüssel = $_POST['zugangsschluessel'];
            


            $elternsql = new ElternSQL();
            if ($elternsql->correctKey($zugangsschlüssel)) {
                $schuelersql = new SchuelerSQL();

                $schuelersql->beziehung_kind_eltern($zugangsschlüssel, User::getInstance()->getBenutzername());

                $schuelersql->zugangsschluessel_loeschen($zugangsschlüssel,  User::getInstance()->getBenutzername());
                
            } else {
                print $this->__toString();
            }
            
        }
        if (array_key_exists("Zurueck", $_POST)) {

                //Meldung generieren, Popup oder Status
                $benutzerid = User::getInstance()->getBenutzerId();
                
                print "Sie haben Probleme bei der Zuordnung weiterer Kinder? M&ouml;glicherweise ist Ihr Zugangsschl&uuml;ssel fehlerhaft. Melden Sie sich mit Ihrem Benutzernamen und Ihrer Benutzernummer bei der Verwaltung oder beim Systemadmin.";
                print "Benutzername:" . User::getInstance()->getBenutzername() . " Benutzernummer:" . User::getInstance()->getBenutzerId() . "";
            }
    }

    public function getStatusText() {
        return $this->statusText;
    }

    public function __toString() {
        $form = new Template("WKindHinzufuegen.tmpl.html");
        return $form->__toString();
    }

}
