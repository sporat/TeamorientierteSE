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
			$infoid = $_POST["infoid"];
			$bezeichnung = $_POST["bezeichnung"];
			$benutzerid = $_POST["benutzerid"];
			$gültigkeitsdatum = $_POST["gültigkeitsdatum"];
			
						
			// neues Model instanziieren und das Laden aus der DB verlassen. Falls dieser Artikel noch
			// nicht vorhanden ist und das Laden fehl schlägt, Artikel neu erstellen lassen.
			$this->information = new Info();
                        $this->infosafe = new InfoSQL();
				 
			//if (!$this->schueler->laden($kindid)) {
				
			//	$this->schueler = new SchuelerSQL($kindid, $name, $vorname, $geburtsdatum, $strasse, $ort, $plz, $jahrgangsstufe);
			//}
		
			// Das Model zum Speichern in die DB veranlassen
			if ($this->schuelersafe->speichern($kindid, $name, $vorname, $geburtsdatum, $strasse, $ort, $plz, $jahrgangsstufe)) 
			{
				// ggf. Erfolgsmeldung generieren
				$this->statusText = "Benutzer ('".$name."', '".$vorname."' wurde erfolgreich geändert!";

			} else {

				// ggf. Fehlermeldung generieren
				$this->statusText = "Benutzer ('".$name."', '".$vorname."' wurde nicht erfolgreich geändert!";

				// Erneut diese Klasse zur Anzeige verwenden
				$_REQUEST["contentId"] = self::$CONTENT_ID;
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
			$this->schueler = new Schueler();
			$this->schueler->laden($_REQUEST["id"]);
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
		$form = new Template("SchuelerAendern.tmpl.html");

		// Daten des Models eintragen
		$form->setValue("[kindid]", $this->schueler->getKindId());
		$form->setValue("[vorname]", $this->schueler->getVorname());
		$form->setValue("[name]", $this->schueler->getName());
		$form->setValue("[geburtsdatum]", $this->schueler->getGeburtsdatum());
		$form->setValue("[strasse]", $this->schueler->getStrasse());
		$form->setValue("[plz]", $this->schueler->getPLZ());
		$form->setValue("[ort]", $this->schueler->getOrt());
		$form->setValue("[jahrgangsstufe]", $this->schueler->getJahrgangsstufe());
		
		// Daten zur Ausführungssteuerung übergeben
		$form->setValue("[contentId]", "info_aendern");
		$form->setValue("[submitKey]", $this->submitKey);

		// erstelltes Formular zurück geben
		return $form->__toString();
	}

}