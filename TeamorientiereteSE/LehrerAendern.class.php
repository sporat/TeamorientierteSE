<?php
require_once("LehrerInfo.class.php");
require_once("Template.class.php");
//require_once("Staff.class.php");

class LehrerAendern {

	public static $CONTENT_ID = "lehrerAendern";
	private $lehrer;
	private $statusText;
	private $submitKey = "bearbeitetenLehrerBestaetigen";
	private $benutzerid;
	private $vorname;
	private $nachname;
	private $benutzername;
	private $passwort;
	private $raum;
	private $rolleid;
	private $email;
        private $telefon;
	
	public function getLehrer() {
		return $this->lehrer;
	}

	public function setLehrer($lehrer) {
		$this->lehrer = $lehrer;
	}

	public function doActions() {

		// Prüfen ob das Formular dieser Sicht übergeben wurde
		if (array_key_exists($this->submitKey, $_REQUEST)) {
			
			// benötigte Werte aus $_REQUEST-Array auslesen und in lokaler Variable zwischenspeichern
			$this->benutzerid = $_POST["benutzerid"];
			$this->vorname = $_POST["vorname"];
			$this->name = $_POST["name"];
			$this->benutzername = $_POST["benutzername"];
			$this->passwort = $_POST["passwort"];
			$this->raum = $_POST["raum"];
			$this->telefon = $_POST["telefon"];
			$this->rolle = $_POST["rolle"];
			$this->email = $_POST["email"];
                        $this->sprechstundeTag = $_POST["sprechstundeTag"];
                        $this->sprechstundeZeit = $_POST["sprechstundeZeit"];
                        $this->funktion = $_POST["funktion"];
                        $this->klassenlehrer = $_POST["klassenlehrer"];
			
			// neues Model instanziieren und das Laden aus der DB verlassen. Falls dieser Artikel noch
			// nicht vorhanden ist und das Laden fehl schlägt, Artikel neu erstellen lassen.
			$this->lehrer = new LehrerInfo();
				 
			if (!$this->lehrer->laden($this->benutzerid)) {
				
				$this->lehrer = new LehrerInfo($this->benutzerid, $this->benutzername, $this->passwort, $this->vorname, $this->name, $this->email, $this->telefon, $this->raum, $this->rolle, $this->sprechstundeTag, $this->sprechstundeZeit, $this->funktion, $this->klassenlehrer);
			}
		
			// Das Model zum Speichern in die DB veranlassen
			if ($this->lehrer->speichern($this->benutzerid, $this->benutzername, $this->passwort, $this->vorname, $this->name, $this->email, $this->telefon, $this->raum, $this->rolle, $this->sprechstundeTag, $this->sprechstundeZeit, $this->funktion, $this->klassenlehrer)) 
			{
				// ggf. Erfolgsmeldung generieren
				$this->statusText = "Benutzer {$this->benutzername} wurde erfolgreich geändert!";

			} else {

				// ggf. Fehlermeldung generieren
				$this->statusText = "Benutzer {$this->benutzername} wurde nicht erfolgreich geändert!";

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
			$this->lehrer = new LehrerInfo();
			$this->lehrer->laden($_REQUEST["id"]);
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
		$form = new Template("LehrerAendern.tmpl.html");

		// Daten des Models eintragen
		$form->setValue("[benutzerid]", $this->lehrer->getBenutzerID());
		$form->setValue("[vorname]", $this->lehrer->getVorname());
		$form->setValue("[name]", $this->lehrer->getName());
		$form->setValue("[benutzername]", $this->lehrer->getBenutzername());
		$form->setValue("[passwort]", $this->lehrer->getPasswort());
		$form->setValue("[rolle]", $this->lehrer->getRolle());
		$form->setValue("[raum]", $this->lehrer->getRaum());
		$form->setValue("[email]", $this->lehrer->getEmail());
		$form->setValue("[telefon]", $this->lehrer->getTelefon());
                $form->setValue("[sprechstundeTag]", $this->lehrer->getSprechstundeTag());
                $form->setValue("[sprechstundeZeit]", $this->lehrer->getSprechstundeZeit());
                $form->setValue("[funktion]", $this->lehrer->getFunktion());
		if ($this->lehrer->getKlassenlehrer()== 0) {
		$klassenlehrer = "nein";
		}
		else
		{
		$klassenlehrer = "ja";
		}
                $form->setValue("[klassenlehrer]", $klassenlehrer);
		

		// Daten zur Ausführungssteuerung übergeben
		$form->setValue("[contentId]", LehrerUeberblick::$CONTENT_ID);
		$form->setValue("[submitKey]", $this->submitKey);

		// erstelltes Formular zurück geben
		return $form->__toString();
	}

}