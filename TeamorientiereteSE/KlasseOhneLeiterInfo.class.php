<?php
	require_once("KlassenOhneLeiterEigenschaften.class.php");
	require_once("DBStatement.class.php");
	require_once("DBConnection.class.php");
	
	class KlasseOhneLeiterInfo extends KlasseOhneLeiterEigenschaften {

		
		// Konstruktor
		public function __construct($klasseid = null, $jahrgangsstufe = "", $kuerzel = "") {
                        $this->klasseid = $klasseid;
			$this->jahrgangsstufe = $jahrgangsstufe;
			$this->kuerzel = $kuerzel;
			     
		}
		
		// Textuelle Repräsentation eines Objektes dieser Klasse
		public function __toString() {
			return $this->klasseid;// . " (Benutzer: " . $this->name . "; Adresse: " . $this->adresse. "; Ort.: " . $this->ort . ";)";
		}
		
	
		/**
		 * Läd einen Benutzer
		 * 
		 * @return ob der Benutzer geladen werden konnte oder nicht
		 */
		public function laden($klasseid) {
			$statement = new DBStatement(DBConnection::getInstance());
                        
			$statement->executeQuery("SELECT * FROM klasse WHERE KlasseID = $klasseid;");
			if ($row = $statement->getNextRow()) {
				$this->klasseid = $klasseid;
				$this->jahrgangsstufe = $row["Jahrgangsstufe"];
				$this->kuerzel = $row["Kuerzel"];
				
				return true;
			}
			return false;
		}

				
		public function zuKlassenleiterMachen($klasseid) {			
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
