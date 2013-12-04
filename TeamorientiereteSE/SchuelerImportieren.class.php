<?php
require_once("VerwaltungSQL.class.php");
require_once ('SchuelerAnlegen.class.php');

class SchuelerImportieren{

private $benutzer_liste ;
private $statusTxt ="";
private $submitkey ="datenImportieren";
public function doActions() {
    if(array_key_exists($this->submitkey, $_REQUEST)){
            $csv = $_FILES['dok'];
            $err = $csv['error'];
            
   if ($err == 0) {
    $schuelerAnlegen= new SchuelerAnlegen();
    $verwaltungSQL = new VerwaltungSQL;
$this->benutzer_liste = file($csv['tmp_name']);

foreach ($this->benutzer_liste as $schueler)
{  $zugangsschluessel= $schuelerAnlegen->generateRandomString();
    list($name, $vorname, $jahrgangsstufe, $strasse, $plz,  $ort, $geburtsdatum,) = explode(';', $schueler);
   
if($verwaltungSQL->schuelerAnlegen($zugangsschluessel, $name, $vorname, $geburtsdatum, $strasse, $plz, $ort, $jahrgangsstufe, $jahrgangsstufe))
{
    $this->statusTxt .= "Schülerdaten erfolgreich importiert";
}
}
                
                // Folgende Fehler können auftreten:
            } elseif ($err == 1) {
                $this->statusTxt .="Das Dokument ist zu groß!<br>";
// Datei ist größer als laut PHP.ini erlaubt
            } elseif ($err == 2) {
                $this->statusTxt .="Die Datei ist zu groß!<br>";
// Datei ist größer als von MAX_FILE_SIZE im Formular erlaubt
            } elseif ($err == 3) {
                $this->statusTxt .="Das Dokument konnte nur teilweise importiert werden!<br>";
// Die Datei wurde nur teilweise hochgeladen
            } elseif ($err == 4) {
                $this->statusTxt .="Es wurde keine Datei importiert!<br>";
// es wurde keine Datei hochgeladen
            }

    }
}


public function getStatusText(){
    return $this->statusTxt;
}
public function __toString() {
    $form = new Template("SchuelerImportieren.tmpl.html");
    return $form->__toString();
}

}
        