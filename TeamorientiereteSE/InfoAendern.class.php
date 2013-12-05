<?php
require_once("Info.class.php");
require_once("InfoSQL.class.php");
require_once("Template.class.php");


class InfoAendern {

	public static $CONTENT_ID = "infoAendern";
	private $information;
	private $statusText;
	private $submitKey = "InfoAendern";
	private $infoid;
	private $bezeichnung;
	private $benutzerid;
	private $gültigkeitsdatum;
        private $text;
        private $infosafe;
	
	public function getInfo() {
		return $this->information;
	}

	public function setInfo($information) {
		$this->information = $information;
	}

	public function doActions() {

		// Prüfen ob das Formular dieser Sicht übergeben wurde
		if (array_key_exists($this->submitKey, $_REQUEST)) {
			
			// benötigte Werte aus $_REQUEST-Array auslesen und in lokaler Variable zwischenspeichern
			$this->infoid = $_POST["infoid"];
			$this->bezeichnung = $_POST["bezeichnung"];
			$this->gültigkeitsdatum = $_POST["gültigkeitsdatum"];
			$this->text = $_POST["textfeld"];
			$benutzerid = User::getInstance()->getBenutzerId();	
			// neues Model instanziieren und das Laden aus der DB verlassen. Falls dieser Artikel noch
			// nicht vorhanden ist und das Laden fehl schlägt, Artikel neu erstellen lassen.
			$this->information = new Info();
                        $this->infosafe = new InfoSQL();
				 
			//if (!$this->schueler->laden($kindid)) {
				
			//	$this->schueler = new SchuelerSQL($kindid, $name, $vorname, $geburtsdatum, $strasse, $ort, $plz, $jahrgangsstufe);
			//}
		
			// Das Model zum Speichern in die DB veranlassen
			if ($this->infosafe->aendern($this->infoid, $this->gültigkeitsdatum, $this->text, $this->bezeichnung, $benutzerid)) 
			{
				$_REQUEST["contentId"] = "info_aendern_klasse";
              
// ggf. Erfolgsmeldung generieren
				//$this->statusText = "Information '".$this->bezeichnung."' wurde erfolgreich geändert!";

			} else {

				// ggf. Fehlermeldung generieren
				$this->statusText = "Information '".$this->bezeichunung."' wurde nicht erfolgreich geändert!";

				// Erneut diese Klasse zur Anzeige verwenden
				$_REQUEST["contentId"] = "information_aendern";
			}

			/*
			 * Mögliche Meldung die im Zuge der verarbeitung entstehen sollte in den Meldungspuffer
			 * der GUI gelegt werden:
			 *
			 * 	$this->statusText = " ... Meldung ... ";
			 *
			 */
				
				
		
		}
		// Prüfen ob ArtikelNr zum Laden des Models übergeben wurde
		elseif (array_key_exists("id", $_REQUEST)) {
			// Model instanziieren und laden
			$this->infosafe = new InfoSQL();
			$this->infosafe->laden($_REQUEST["id"]);
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
		// Erstellen des Login-Formulars mit Hilfe des zugehörigen Templates
		$form = new Template("InfoAendern.tmpl.html");

		// Daten des Models eintragen
               if ($this->infosafe->getBezeichnung()=="Hausaufgabe"){
                    $form->setValue("selected0",'selected'); 
                    }
                elseif ($this->infosafe->getBezeichnung()=="allgemeine Informationen"){
                    $form->setValue("selected1",'selected'); 
                    }
                elseif ($this->infosafe->getBezeichnung()=="Sonstiges")
                {
                    $form->setValue("selected2",'selected');
                }
                
		$form->setValue("[infoid]", $_REQUEST["id"]);
		$form->setValue("[gültigkeitsdatum]", $this->infosafe->getGültigkeitsdatum());
		$form->setValue('leer', $this->infosafe->getText());
				
		// Daten zur Ausführungssteuerung übergeben
		$form->setValue("[contentId]", "info_aendern_klasse");
		

		// erstelltes Formular zurück geben
		return $form->__toString();
	}

}