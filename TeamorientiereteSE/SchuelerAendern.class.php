<?php
require_once("Schueler.class.php");
require_once("SchuelerSQL.class.php");
require_once("Template.class.php");


class SchuelerAendern {

	public static $CONTENT_ID = "schuelerAendern";
	private $schueler;
	private $statusText;
	private $submitKey = "bearbeitetenSchuelerBestaetigen";
	private $kindid;
	private $vorname;
	private $name;
	private $strasse;
	private $ort;
	private $plz;
	private $geburtsdatum;
	private $jahrgangsstufe;
	
	public function getSchueler() {
		return $this->schueler;
	}

	public function setSchueler($schueler) {
		$this->schueler = $schueler;
	}

	public function doActions() {

		// Prüfen ob das Formular dieser Sicht übergeben wurde
		if (array_key_exists($this->submitKey, $_REQUEST)) {
			
			// benötigte Werte aus $_REQUEST-Array auslesen und in lokaler Variable zwischenspeichern
			$kindid = $_POST["kindid"];
			$vorname = $_POST["vorname"];
			$name = $_POST["name"];
			$geburtsdatum = $_POST["geburtsdatum"];
			$strasse = $_POST["strasse"];
			$ort = $_POST["ort"];
			$plz = $_POST["plz"];
			$jahrgangsstufe = $_POST["jahrgangsstufe"];
			//$rolle= "Schüler";
						
			// neues Model instanziieren und das Laden aus der DB verlassen. Falls dieser Artikel noch
			// nicht vorhanden ist und das Laden fehl schlägt, Artikel neu erstellen lassen.
			$this->schueler = new Schueler();
                        $this->schuelersafe = new SchuelerSQL();
				 
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
		$form->setValue("[contentId]", SchuelerUeberblick::$CONTENT_ID);
		$form->setValue("[submitKey]", $this->submitKey);

		// erstelltes Formular zurück geben
		return $form->__toString();
	}

}