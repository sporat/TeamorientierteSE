<?php
	require_once("KlassenOhneLeiterEigenschaften.class.php");
	require_once("DBStatement.class.php");
	require_once("DBConnection.class.php");
	//
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

				
		public function zuKlassenleiterMachen($klasseid, $benutzerid) {						
			$statement = new DBStatement(DBConnection::getInstance());
			
			$sql = "INSERT INTO `klassenlehrer`(`BenutzerID`, `KlasseID`) VALUES ('$benutzerid','$klasseid')";
			$statement->executeQuery($sql);
                }
                
                /*prüft, ob der angemeledete Klassenlehrer bereits Lehrer ist
                 * gibt false zurück, wenn er bereits klassenleiter ist, false,wenn nicht
                 */
                public function KlassenleitungUeberpruefen($benutzerid) {	
                        $statement = new DBStatement(DBConnection::getInstance());
                        $query = "select * from klassenlehrer where benutzerid = $benutzerid";
                        $statement->executeQuery($query);
                        $erg = mysql_num_rows(mysql_query($query));
                        if($erg>0) {
                            return 0;
                        }else return 1;
                }
	}
?>
