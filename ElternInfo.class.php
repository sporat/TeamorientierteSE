<?php
	require_once("ElternEigenschaften.class.php");
	require_once("DBStatement.class.php");
	require_once("DBConnection.class.php");
	
	class ElternInfo extends ElternEigenschaften {

		
		// Konstruktor
		public function __construct($benutzerid = null, $benutzername = "", $passwort = "", $vorname = "", $name ="", $email="", $telefon="", $rolle = "", $status = null, $mitteilungsweg = "") {
                        $this->benutzerid = $benutzerid;
			$this->benutzername = $benutzername;
			$this->vorname = $vorname;
			$this->name = $name;
			$this->passwort = $passwort;
			$this->email = $email;
			$this->telefon = $telefon;
                        $this->rolle = $rolle;
			$this->status = $status; 
                        $this->mitteilungsweg = $mitteilungsweg; 
                        
		}
		
		// Textuelle Repräsentation eines Objektes dieser Klasse
		public function __toString() {
			return $this->benutzerid;// . " (Benutzer: " . $this->name . "; Adresse: " . $this->adresse. "; Ort.: " . $this->ort . ";)";
		}
		
	
		/**
		 * Lädt die Eltern mit der übergebenen ID
		 * 
		 * @return ob der Benutzer geladen werden konnte oder nicht
		 */
		public function laden($benutzerid) {
			$statement = new DBStatement(DBConnection::getInstance());
                        
			$statement->executeQuery("SELECT * 
                                                  FROM Benutzer
                                                  LEFT JOIN Eltern ON Benutzer.BenutzerID = Eltern.BenutzerID
                                                  WHERE rolle =  'Eltern'
                                                  and Benutzer.BenutzerID =  '$benutzerid';");
			if ($row = $statement->getNextRow()) {
				$this->benutzerid = $benutzerid;
				$this->benutzername = $row["Benutzername"];
				$this->vorname = $row["Vorname"];
				$this->name = $row["Name"];
				$this->email = $row["Email"];
				$this->telefon = $row["Telefon"];
                                $this->passwort = $row["Passwort"];
				$this->rolle = $row["Rolle"];
                                $this->status = $row["Status"];
                                $this->mitteilungsweg = $row["Mitteilungsweg"];
			}
			return false;
		}

		/*public function getRole($rolleName) {
			if($rolleName == 'Administrator'){
				$this->rolleid  = 1;
			}
			if($rolleName == 'Arbeitsvorbereiter'){
				$this->rolleid  = 2;
			}
			if($rolleName == 'Werker'){
				$this->rolleid  = 3;
			}
			return $this->rolleid;
		}*/
		
		
			
		
	}
?>
