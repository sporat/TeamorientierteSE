<?php

require_once("Klassenlehrer_or_notListe.class.php");

require_once("LehrerInfo.class.php");
require_once("LehrerSQL.class.php");

class Klassenlehrer_or_notUeberblick {

    private $submitKey = "Aendern";
    private $contentId;
    private $klassenlehrer_or_notListe;
    private $lehrersql;
    public $checkbox;
    public $i;
    private $form;
	private $statusText;

    public function __construct() {
        $this->klassenlehrer_or_notListe = new Klassenlehrer_or_notListe();
        $this->lehrersql = new LehrerSQL();
    }
public function getStatusText() {
return $this->statusText;   
 }
    public function doActions() {

        // Prüfen ob das Formular dieser Sicht übergeben wurde
        if (array_key_exists($this->submitKey, $_POST)) {
            $this->contentId = $_POST['contentId'];
	
			
            if ($this->contentId == "klassenlehrermarkierung_loeschen") {
			
                if (empty($_POST['KLehrerAend'])) {
                    $this->statusText= "Kein Lehrer ausgewählt";
                } else {
                    for ($i=0; $i<count($_POST['KLehrerAend']); $i++) {
$arr=$_POST['KLehrerAend'];
$anzahl = count($_POST['KLehrerAend']);
//print $i;
//print "Anzahl" . $anzahl;
$status=$anzahl-1;

                        if (!$this->lehrersql->hatKlassenleitung($arr[$i])) {




                            $this->lehrersql->resetKlassenlehrer($arr[$i]);
                            print "Lehrer ist kein Klassenlehrer mehr";
                            if ($i==$status)
							{
							
							$_REQUEST['contentId'] = "";
							}
							
                            //$this->status.= "Schüler wurde zu Kurs hinzugefügt!";
                        } else {
                            if ($i==$status)
							{
							
							$_REQUEST["contentId"] = "team";
							}
							print "Lehrer ist einer Klasse als Klassenleiter zugeordnet. Die Markierung als Klassenleiter kann nicht aufgehoben werden.";
                        }  
                    }
                }
            } elseif ($this->contentId == "lehrer_zu_klassenlehrer") {
                if (empty($_POST['KLehrerAend'])) {
                    
                } else {
                    for ($i=0; $i<count($_POST['KLehrerAend']); $i++) {
$arr=$_POST['KLehrerAend'];
$anzahl = count($_POST['KLehrerAend']);
//print $i;
//print "Anzahl" . $anzahl;
$status=$anzahl-1;
                    foreach ($_POST['KLehrerAend'] as $lehrer) {





                        //Speichern über Kursklasse abwickeln
                        $this->lehrersql->setKlassenlehrer($lehrer);
                        print "Lehrer wurde als Klassenlehrer markiert";
                        if ($i==$status)
							{
							
							$_REQUEST['contentId'] = "";
							}
                        //$this->status.= "Schüler wurde zu Kurs hinzugefügt!";
                    } 
                }
            }
        }
    }
    }

    public function __toString() {
        $this->form = new Template("Klassenlehrer_or_notUeberblick.tmpl.html");
        $i = 0;
        $checkbox = "";
        $htmlStr = "";
        foreach ($this->klassenlehrer_or_notListe->getLehrer() as $lehrer) {


            $this->form = new Template("Klassenlehrer_or_notUeberblick.tmpl.html");
            $benutzerID = $lehrer->getBenutzerID();

            $checkbox .= "<input type='checkbox' name='KLehrerAend[]' value='$benutzerID'>";

            $htmlStr .= sprintf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>", $lehrer->getBenutzerID(), $lehrer->getBenutzername(), $lehrer->getVorname(), $lehrer->getName(), $lehrer->getRolle(), "<input type='checkbox' name='KLehrerAend[]' value='$benutzerID'>");

            // Daten des Models eintragen
            $this->form->setValue("[htmlStr]", $htmlStr);
            $this->form->setValue("[checkbox]", $checkbox);
            $this->form->setValue("[contentId]", $_REQUEST['contentId']);
        }


        // erstelltes Formular zurück geben
        return $this->form->__toString();
    }

}
