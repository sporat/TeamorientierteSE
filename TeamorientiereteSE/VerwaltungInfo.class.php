<?php
	require_once("VerwaltungEigenschaften.class.php");
	require_once("DBStatement.class.php");
	require_once("DBConnection.class.php");
	
	class VerwaltungInfo extends VerwaltungEigenschaften {

		
		// Konstruktor
		public function __construct($benutzerid = null, $benutzername = "", $passwort = "", $vorname = "", $nachname ="", $email="", $telefon="", $raum="", $rolle = "") {
                        $this->benutzerid = $benutzerid;
			$this->benutzername = $benutzername;
			$this->vorname = $vorname;
			$this->nachname = $nachname;
			$this->passwort = $passwort;
			$this->email = $email;
			$this->telefon = $telefon;
			$this->raum = $raum;
			$this->rolle = $rolle;       
		}
		
		// Textuelle Repräsentation eines Objektes dieser Klasse
		public function __toString() {
			return $this->benutzerid;// . " (Benutzer: " . $this->name . "; Adresse: " . $this->adresse. "; Ort.: " . $this->ort . ";)";
		}
		
	
		/**
		 * Läd einen Benutzer
		 * 
		 * @return ob der Benutzer geladen werden konnte oder nicht
		 */
		public function laden($benutzerid) {
			$statement = new DBStatement(DBConnection::getInstance());
                        
			$statement->executeQuery("SELECT * FROM benutzer WHERE BenutzerID = $benutzerid;");
			if ($row = $statement->getNextRow()) {
				$this->benutzerid = $benutzerid;
				$this->benutzername = $row["Benutzername"];
				$this->vorname = $row["Vorname"];
				$this->name = $row["Name"];
				$this->email = $row["Email"];
				$this->telefon = $row["Telefon"];
                                $this->passwort = $row["Passwort"];
				//$this->raum = $row["Raum"];
				$this->rolle = $row["Rolle"];
				
				return true;
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
		
		public function speichern($benutzerid, $benutzername, $passwort, $vorname, $name, $email, $telefon, $rolle) {			
			//$rolle_id = $this->getRole($rolleName);
			
			$statement = new DBStatement(DBConnection::getInstance());
			
			$sql = "UPDATE "
                                    .   "`benutzer` "
                               . "SET "   
                                    .   "`Benutzername`= '$benutzername',"
                                    .   "`Passwort`= '$passwort',"
                                    .   "`Vorname`= '$vorname',"
                                    .   "`Name`= '$name',"
                                    .   "`Email`= '$email',"
                                    .   "`Rolle`= '$rolle',"
                                    .   "`Telefon`= '$telefon'"
                               . " WHERE BenutzerID = '$benutzerid'";
                        
			$statement->executeQuery($sql);
                }
	}
?>
