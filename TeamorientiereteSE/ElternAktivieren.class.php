<?php

require_once ("ElternSQL.class.php");

/**
 * 

 * 
 */
class ElternAktivieren {

    private $submitKey = "eltern_aktivieren";
    private $statusText;
    public static $CONTENT_ID;

    public function doActions() {

        if (array_key_exists($this->submitKey, $_POST)) {


            $elternsql = new ElternSQL();
               
                $elternsql->aktivieren($elternsql->getBenutzerID($_POST['benutzername']));
                //status
                print "Benutzer '".$benutzername."' ist wieder aktiviert und kann sich am System anmelden.";
            
        }
    }

    public function getStatusText() {
        return $this->statusText;
    }

    public function __toString() {
        $this->form = new Template("ElternAktivieren.tmpl.html");
        
        return $this->form->__toString();
    }

}
