<?php

require_once ("ElternSQL.class.php");
require_once ("SchuelerSQL.class.php");

/**
 * 


 * 
 */
class KindHinzufuegen {

    private $submitKey = "Kind zuordnen";
    private $submitKey2 = "Abbrechen";
    private $statusText;

    public function doActions() {
        $elternsql = new ElternSQL();
        if (array_key_exists($this->submitKey, $_POST)) {
            $zugangsschlüssel = $_POST['zugangsschluessel'];
            $benutzername = $_POST['benutzername'];


            $elternsql = new ElternSQL();
            if ($elternsql->correctKey($zugangsschlüssel)) {
                $schuelersql = new SchuelerSQL();

                $schuelersql->beziehung_kind_eltern($zugangsschlüssel, $benutzername);

                $schuelersql->zugangsschluessel_loeschen($zugangsschlüssel, $benutzername);
                $elternsql->aktivieren($elternsql->getBenutzerID($benutzername));
            } else {
                print $this->__toString();
            }
            
        }
        if (array_key_exists($this->submitKey2, $_POST)) {

                //Meldung generieren, Popup oder Status
                $benutzerid = $elternsql->getBenutzerID($_POST['benutzername']);
                print "Sie wollten sich registrieren? Falls Sie sich nicht mindestens einem Kind zugeordnet haben, sind Sie im System nicht aktiviert. Wenden Sie sich bitte mit Ihrem Benutzername und Ihrer Benutzernummer beim Systemadministrator oder der Verwaltung.";
                print "Benutzername:" . $_POST['benutzername'] . " Benutzernummer:" . $benutzerid . "";
            }
    }

    public function getStatusText() {
        return $this->statusText;
    }

    public function __toString() {
        $form = new Template("KindHinzufuegen.tmpl.html");

        $name = $_POST['benutzername'];
        $form->setValue("[benutzername]", $name);
        $form->setValue("[submitkey]", "Kind zuordnen");
        $form->setValue("[reset]", "Abbrechen");
        return $form->__toString();
    }

}
