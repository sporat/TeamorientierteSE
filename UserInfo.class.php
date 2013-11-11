<?php
	require_once("Staff.class.php");
	require_once("DBStatement.class.php");
	require_once("DBConnection.class.php");
	
	class UserInfo extends Staff {

		
		// Konstruktor
		public function __construct($benutzerid = null, $benutzername = "", $passwort ="", $vorname = "", $nachname ="", $email="", $telefon="", $raum="", $rolle = "") {
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
			$connect = new DBConnection();
			$statement = new DBStatement($connect);
			$statement->executeQuery("SELECT * FROM benutzer WHERE BenutzerID = $benutzerid;");
			if ($row = $statement->getNextRow()) {
				$this->benutzerid = $benutzerid;
				$this->benutzername = $row["Benutzername"];
				$this->vorname = $row["Vorname"];
				$this->name = $row["Name"];
				$this->email = $row["Email"];
				$this->telefon = $row["Telefon"];
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
		
		public function speichern($benutzerid, $benutzername, $passwort, $vorname, $nachname, $email, $telefon, $raum, $rolleid) {			
			$rolle_id = $this->getRole($rolleName);
			
			$connect = new DBConnection();
			$statement = new DBStatement($connect);
			
			$sql = "UPDATE "
                                    .   "`benutzer` "
                               . "SET "   
                                    .   "`Benutzername`= '$benutzername',"
                                    .   "`Passwort`= '$passwort',"
                                    .   "`Name`= '$nachname',"
                                    .   "`Vorname`= '$vorname',"
                                    .   "`Nachname`= '$nachname',"
                                    .   "`Email`= '$email',"
                                    .   "`RolleID`= '$rolleid',"
                                    .   "`Telefon`= '$telefon'"
                               . "WHERE BenutzerID = '$benutzerid'";			
			if($statement->getAffectedRowsCount($statement->executeQuery($sql))>0)
			return true;
			else return false;
			
		}
	}
?>
