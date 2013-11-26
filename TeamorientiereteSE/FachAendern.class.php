<?php
require_once("Fach.class.php");
require_once("FachSQL.class.php");
require_once("Template.class.php");


class FachAendern {

	public static $CONTENT_ID = "fachAendern";
	private $fach;
	private $statusText;
	private $submitKey = "bearbeitetenFachBestaetigen";
	private $fachid;
	private $bezeichnung;
	private $fachsafe;
	
	public function getFach() {
		return $this->fach;
	}

	public function setFach($fach) {
		$this->fach = $fach;
	}

	public function doActions() {

		// Prüfen ob das Formular dieser Sicht übergeben wurde
		if (array_key_exists($this->submitKey, $_REQUEST)) {
			
			// benötigte Werte aus $_REQUEST-Array auslesen und in lokaler Variable zwischenspeichern
			$fachid = $_POST["fachid"];
			$bezeichnung = $_POST["bezeichnung"];
			
						
			// neues Model instanziieren und das Laden aus der DB verlassen. Falls dieser Artikel noch
			// nicht vorhanden ist und das Laden fehl schlägt, Artikel neu erstellen lassen.
			$this->fach = new Fach();
            $this->fachsafe = new FachSQL();
				 
			
		
			// Das Model zum Speichern in die DB veranlassen
			if ($this->fachsafe->speichern($fachid, $bezeichnung)) 
			{
				// ggf. Erfolgsmeldung generieren
				$this->statusText = "Fach ('".$bezeichnung."') wurde erfolgreich geaendert!";

			} else {

				// ggf. Fehlermeldung generieren
				$this->statusText = "Fach ('".$bezeichnung."') wurde nicht erfolgreich geaendert!";

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
			$this->fach = new Fach();
			$this->fach->laden($_REQUEST["id"]);
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
		$form = new Template("FachAendern.tmpl.html");

		// Daten des Models eintragen
		$form->setValue("[fachid]", $this->fach->getFachID());
		$form->setValue("[bezeichnung]", $this->fach->getBezeichnung());
		
		
		// Daten zur Ausführungssteuerung übergeben
		$form->setValue("[contentId]", FachUeberblick::$CONTENT_ID);
		$form->setValue("[submitKey]", $this->submitKey);

		// erstelltes Formular zurück geben
		return $form->__toString();
	}

}