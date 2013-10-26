<?php 
	class Template {
	
		private $skeleton; // Das HTML-Gerüst mit Platzhaltern
		private $values; // Die Werte der Platzhalter
	
		// Erstellt ein Template-Objekt auf Basis einer 
		// Template-Datei 
		
		public function __construct($skeletonPath) {
			$this->skeleton = file_get_contents($skeletonPath);
			$this->values = array();
		}
		
		// Erlaubt das festlegen eines Textes für einen Platzhalter
		public function setValue($key, $value) {
			$this->values[$key] = $value;
		}
		
		// Ersetzt alle Platzhalter im Template durch die 
		// festgelegten Texte und gibt das Ergebnis zurück
		public function __toString() {
			$result = $this->skeleton;
			foreach ($this->values as $key => $value) {
				$result = str_replace($key, $value, $result);
			}
		return $result;
		}
	}
?>