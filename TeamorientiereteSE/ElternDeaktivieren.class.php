<?php

require_once ("ElternSQL.class.php");

/**
 * 

 * 
 */
class ElternDeaktivieren {

    private $submitKey = "eltern_deaktivieren";
    private $statusText;
    public static $CONTENT_ID;

    public function doActions() {

        if (array_key_exists($this->submitKey, $_POST)) {


            $elternsql = new ElternSQL();
			$benutzername = $_REQUEST["benutzername"];
               if($elternsql->deaktivieren($elternsql->getBenutzerID($_REQUEST["benutzername"])))
			   {
                //status
                print "Benutzer '".$benutzername."' ist deaktiviert und kann sich nicht mehr am System anmelden.";
				}
				else
				{
				print "Benutzer konnte nicht deaktiviert werden.";
				}
            
        }
    }

    public function getStatusText() {
        return $this->statusText;
    }

    public function __toString() {
        $this->form = new Template("ElternDeaktivieren.tmpl.html");
        
        return $this->form->__toString();
    }

}
