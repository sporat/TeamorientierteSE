<?php
require_once("VerwaltungInfo.class.php");
require_once("Template.class.php");
//require_once("Staff.class.php");

class VerwaltungAendern {

	public static $CONTENT_ID = "adminAendern";
	private $admin;
	private $statusText;
	private $submitKey = "bearbeitetenAdminBestaetigen";
	private $benutzerid;
	private $vorname;
	private $nachname;
	private $benutzername;
	private $passwort;
	private $raum;
	private $rolleid;
	private $email;
        private $telefon;
	
	public function getAdmin() {
		return $this->admin;
	}

	public function setAdmin($admin) {
		$this->admin = $admin;
	}

	public function doActions() {

		// Prüfen ob das Formular dieser Sicht übergeben wurde
		if (array_key_exists($this->submitKey, $_REQUEST)) {
			
			// benötigte Werte aus $_REQUEST-Array auslesen und in lokaler Variable zwischenspeichern
			$benutzerid = $_POST["benutzerid"];
			$vorname = $_POST["vorname"];
			$name = $_POST["name"];
			$benutzername = $_POST["benutzername"];
			$passwort = $_POST["passwort"];
			$raum = $_POST["raum"];
			$telefon = $_POST["telefon"];
			$rolle = $_POST["rolle"];
			$email = $_POST["email"];		
			
			// neues Model instanziieren und das Laden aus der DB verlassen. Falls dieser Artikel noch
			// nicht vorhanden ist und das Laden fehl schlägt, Artikel neu erstellen lassen.
			$this->admin = new VerwaltungInfo();
				 
			if (!$this->admin->laden($benutzerid)) {
				
				$this->admin = new VerwaltungInfo($benutzerid, $benutzername, $passwort, $vorname, $name, $email, $telefon, $raum, $rolle);
			}
		
			// Das Model zum Speichern in die DB veranlassen
			if ($this->admin->speichern($benutzerid, $benutzername, $passwort, $vorname, $name, $email, $telefon, $raum, $rolle)) {
				// ggf. Erfolgsmeldung generieren
				$this->statusText = "Benutzer {$benutzername} wurde erfolgreich geändert!";

			} else {

				// ggf. Fehlermeldung generieren
				$this->statusText = "Benutzer {$benutzername} wurde nicht erfolgreich geändert!";

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
			$this->admin = new VerwaltungInfo();
			$this->admin->laden($_REQUEST["id"]);
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
		$form = new Template("AdminAendern.tmpl.html");

		// Daten des Models eintragen
		$form->setValue("[benutzerid]", $this->admin->getBenutzerID());
		$form->setValue("[vorname]", $this->admin->getVorname());
		$form->setValue("[name]", $this->admin->getName());
		$form->setValue("[benutzername]", $this->admin->getBenutzername());
		$form->setValue("[passwort]", $this->admin->getPasswort());
		$form->setValue("[rolle]", $this->admin->getRolle());
		$form->setValue("[raum]", $this->admin->getRaum());
		$form->setValue("[email]", $this->admin->getEmail());
		$form->setValue("[telefon]", $this->admin->getTelefon());
		

		// Daten zur Ausführungssteuerung übergeben
		$form->setValue("[contentId]", VerwaltungUeberblick::$CONTENT_ID);
		$form->setValue("[submitKey]", $this->submitKey);

		// erstelltes Formular zurück geben
		return $form->__toString();
	}

}