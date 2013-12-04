<?php

require_once("Template.class.php");


class LehrerSuche {

	public static $CONTENT_ID = "infoAendern";
	private $statusText;
	private $submitKey = "bearbeitetenInfoBestaetigen";
	
	
	

	public function doActions() {

		// Prüfen ob das Formular dieser Sicht übergeben wurde
		if (array_key_exists($this->submitKey, $_REQUEST)) {
			
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
		$form = new Template("LehrerSuche.tmpl.html");

		
		return $form->__toString();
	}

}