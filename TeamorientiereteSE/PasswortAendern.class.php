<?php
require_once("User.class.php");
require_once("Template.class.php");
//require_once("Staff.class.php");

class PasswortAendern {

	public static $CONTENT_ID = "passwort_aendern";
	private $user;
	private $statusText;
	private $submitKey = "bearbeitetenPasswortBestaetigen";
	private $benutzerid;
	private $vorname;
	private $nachname;
	private $benutzername;
	private $passwort;
	private $raum;
	private $rolleid;
	private $email;
        private $telefon;
	
	public function getUser() {
		return $this->user;
	}

	public function setUser($user) {
		$this->user = $user;
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
			
			
			$this->rolle = $_POST["rolle"];
					
			
			// neues Model instanziieren und das Laden aus der DB verlassen. Falls dieser Artikel noch
			// nicht vorhanden ist und das Laden fehl schlägt, Artikel neu erstellen lassen.
			$this->user = new User();
				 
			if (!$this->user->laden($this->benutzername)) {
				
				$this->user = new User();
			}
		
			// Das Model zum Speichern in die DB veranlassen
			$this->user->passwortspeichern($this->benutzername, $this->passwort);
                            print "Passwort geändert";
				// ggf. Erfolgsmeldung generieren
				//$this->statusText = "Passwort von Benutzer {$this->benutzername} wurde erfolgreich geändert!";

			//} else {

				// ggf. Fehlermeldung generieren
				//$this->statusText = "Passwort von Benutzer {$this->benutzername} wurde nicht erfolgreich geändert!";

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
				
				
		
		
		// Prüfen ob ArtikelNr zum Laden des Models übergeben wurde
		//elseif (array_key_exists("Benutzername", $_REQUEST)) {
                if (array_key_exists("Benutzername", $_REQUEST)) {
			// Model instanziieren und laden
			$this->user = new User();
			$this->user->laden("Benutzername", $_REQUEST);
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
		$form = new Template("PasswortAendern.tmpl.html");
                $this->user = new User();
		// Daten des Models eintragen
		$form->setValue("[benutzerid]", $this->user->getBenutzerId());
		$form->setValue("[vorname]", $this->user->getVorname());
		$form->setValue("[name]", $this->user->getName());
		$form->setValue("[benutzername]", $_REQUEST['benutzername']);
		$form->setValue("[passwort]", $this->user->getPasswort());
		$form->setValue("[rolle]", $this->user->getRole());
	
		

		// Daten zur Ausführungssteuerung übergeben
		$form->setValue("[contentId]", VerwaltungUeberblick::$CONTENT_ID);
		$form->setValue("[submitKey]", $this->submitKey);

		// erstelltes Formular zurück geben
		return $form->__toString();
	}

}