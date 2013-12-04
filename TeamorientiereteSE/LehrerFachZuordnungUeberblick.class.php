<?php

require_once("FachListeLehrerZuordnung.class.php");
require_once ("LehrerSQL.class.php");

class LehrerFachZuordnungUeberblick {

    public static $CONTENT_ID = "FachOutline";
    private $fachListe;
    private $submitkey = "fach_auswaehlen";
    private $statusTxt;

    public function __construct() {
        $this->fachListe = new FachListeLehrerZuordnung();
    }

    public function doActions() {
        $this->statusTxt ="";
        if (array_key_exists($this->submitkey, $_POST)) {

            $lehrersql = new LehrerSQL();

            


            if (isset($_REQUEST['FachWahl'])) {

                reset($_REQUEST['FachWahl']);
                $i = 0;
                $fach = "";

                foreach ($_REQUEST['FachWahl'] as $k => $v) {
                    print $v;
                    $fachid = $v;

                    if ($lehrersql->hatFach($fachid)) {
                        $this->statusTxt.= "Sie haben sich dem Fach bereits zugeordnet";
                    } else {
                        
                       if($lehrersql->fachZuordnen($fachid)){
                        $this->statusTxt.= "Sie haben sich den ausgewählten Fächern zugeordnet";
                       }
                    }
                }
            } else {

                $i = 0;
                $contentId = "fach_zuordnen";
                $this->statusTxt.= "Sie haben kein Fach ausgewählt!";
                print $this->__toString();
            }
        }
    }

    public function __toString() {

        $checkbox = "";
        $htmlStr = "";

        foreach ($this->fachListe->getFach() as $fach) {

            $form = new Template("LehrerFachZuordnungUeberblick.tmpl.html");
            $fachid = $fach->getFachId();
            $checkbox .= "<input type='checkbox' name='FachWahl[]' value='$fachid'>";

            $htmlStr .= sprintf("<tr><td>%s</td><td>%s</td></tr>", "<input type='checkbox' name='FachWahl[]' value='$fachid'>", $fach->getBezeichnung());

            // Daten des Models eintragen
            $form->setValue('[htmlStr]', $htmlStr);
        }

        // erstelltes Formular zurück geben

        return $form->__toString();
    }
       public function getStatusText()
	{
	return $this->statusTxt;
	}
}
