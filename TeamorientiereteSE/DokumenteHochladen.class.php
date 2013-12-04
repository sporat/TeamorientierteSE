<?php

require_once("DBConnection.class.php");
require_once("DBStatement.class.php");
require_once ("Dokument.class.php");
require_once("FachUeberblickDokument.class.php");
require_once("KlassenUeberblick.class.php");

class DokumenteHochladen {

    private $submitkey = "upload";
    private $statusText = "";
    private $submitKey2 = "schule";
    private $dokumentid;

    public function doAction() {

        if (array_key_exists($this->submitkey, $_REQUEST) or array_key_exists($this->submitKey2, $_REQUEST)) {

            //value von dropdown fach hat gleich die fachid mit gespeichert
            $fachid = $_REQUEST['fach'];
            $dokument = new Dokument();
            $uploadDir = "uploads/";



            $dok = $_FILES['dok'];
            $err = $dok['error'];
            $name = $dok['name'];

            $pathInfo = pathinfo($name);

            if ($pathInfo['filename'] == null) {
                $typ = "";
            } else {
                $typ = $pathInfo['extension'];
            }

            $newPath = $uploadDir . $name;


            if ($err == 0) {
                move_uploaded_file($dok['tmp_name'], $newPath);
                $this->statusText .="Das Dokument wurde erfolgreich hochgeladen!<br>";
                $this->dokumentid = $dokument->upload($newPath, $typ, $name, $fachid);
// speichern das Pfads zur hochgeladenen Datei in der DB

                if (array_key_exists($this->submitkey, $_REQUEST)) {
                    if (isset($_REQUEST['Auswahl'])) {
                        reset($_REQUEST['Auswahl']);
                        $i = 0;
                        $klasse = "";
                        foreach ($_REQUEST['Auswahl'] as $k => $v) {
                            //$k: Stelle im Array (beginnend mit 0); 
                            //$v: Value an der Stelle --> KindId zum Löschen des Kindes

                            $dokument->dokumentKlasseZuordnen($this->dokumentid, $v);
                        }
                        $this->statusText .= "Es ist nur für die Klassen sichtbar, die Sie ausgewählt haben. ";
                    } else {

                        $i = 0;
                        $_POST['contentId'] = "dokument_hochladen";
                        $this->statusText .= "Sie haben keine Klasse ausgewählt!Dieses Dokument ist für keine Klasse sichtbar. Soll es einer Klasse zugeordnet werden, muss es erneut hochgeladen werden.";
                    }
                }
                if (array_key_exists($this->submitKey2, $_REQUEST)) {

                    $klassenid = 'null';
                    if ($dokument->dokumentKlasseZuordnen($this->dokumentid, $klassenid)) {
                        $this->statusText .="Sie haben das Dokument hochgeladen und es allen Klassen zugänglich gemacht.";
                    }
                }
                // Folgende Fehler können auftreten:
            } elseif ($err == 1) {
                $this->statusText .="Das Dokument ist zu groß!<br>";
// Datei ist größer als laut PHP.ini erlaubt
            } elseif ($err == 2) {
                $this->statusText .="Die Datei ist zu groß!<br>";
// Datei ist größer als von MAX_FILE_SIZE im Formular erlaubt
            } elseif ($err == 3) {
                $this->statusText .="Das Dokument konnte nur teilweise hochgeladen werden!<br>";
// Die Datei wurde nur teilweise hochgeladen
            } elseif ($err == 4) {
                $this->statusText .="Es wurde keine Datei hochgeladen!<br>";
// es wurde keine Datei hochgeladen
            }
        }
    }

    public function getStatusText() {
        return $this->statusText;
    }

    public function __toString() {
        $fachliste = new FachUeberblickDokument();
        $klassenliste = new KlassenUeberblick();
        $form = new Template("DokumenteHochladen.tmpl.html");

        $htmlStr = "";
        $htmlStr .= sprintf("Dokument hochladen!<br>");
        $htmlStr .= sprintf("Dokument: <input type='file' name='dok' /><br>");

        $htmlStr .=sprintf("<input type='submit' name='%s' value='hochladen'/>", $this->submitkey);
        $htmlStr .= "<input type='hidden' name='MAX_FILE_SIZE' value='500000000'/>";
        $form->setValue('[htmlStr]', $htmlStr);
        $form->setValue('[faecherListe]', $fachliste->__toString());
        $form->setValue('[klassenListe]', $klassenliste->__toString());
        return $form->__toString();
    }

}
