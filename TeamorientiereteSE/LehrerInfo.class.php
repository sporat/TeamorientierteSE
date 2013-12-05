<?php
	require_once("LehrerEigenschaften.class.php");
	require_once("DBStatement.class.php");
	require_once("DBConnection.class.php");
	
	class LehrerInfo extends LehrerEigenschaften {

		
		// Konstruktor
		public function __construct($benutzerid = null, $benutzername = "", $passwort = "", $vorname = "", $name ="", $email="", $telefon="", $raum="", $rolle = "", $sprechstundeTag = "", $sprechstundeZeit = "", $funktion = "", $klassenlehrer = null) {
                        $this->benutzerid = $benutzerid;
			$this->benutzername = $benutzername;
			$this->vorname = $vorname;
			$this->name = $name;
			$this->passwort = $passwort;
			$this->email = $email;
			$this->telefon = $telefon;
			$this->raum = $raum;
                        $this->rolle = $rolle;
			$this->sprechstundeTag = $sprechstundeTag; 
                        $this->sprechstundeZeit = $sprechstundeZeit; 
                        $this->funktion = $funktion; 
                        $this->klassenlehrer = $klassenlehrer; 
                        
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
                        
			$statement->executeQuery("select benutzer.*,lehrer.Sprechstunde_Tag, lehrer.Sprechstunde_Uhrzeit, Lehrer.Raum, Lehrer.Funktion, lehrer.Klassenlehrer from lehrer left join Benutzer on lehrer.benutzerid = benutzer.benutzerID WHERE benutzer.BenutzerID = '$benutzerid';");
			if ($row = $statement->getNextRow()) {
				$this->benutzerid = $benutzerid;
				$this->benutzername = $row["Benutzername"];
				$this->vorname = $row["Vorname"];
				$this->name = $row["Name"];
				$this->email = $row["Email"];
				$this->telefon = $row["Telefon"];
                                $this->passwort = $row["Passwort"];
				$this->raum = $row["Raum"];
				$this->rolle = $row["Rolle"];
                                $this->sprechstundeTag = $row["Sprechstunde_Tag"];
                                $this->sprechstundeZeit = $row["Sprechstunde_Uhrzeit"];
                                $this->funktion = $row["Funktion"];
                                $this->klassenlehrer = $row["Klassenlehrer"];
				return true;
			}
			return false;
		}
                
                public function ladenSuche($benutzerid) {
			$statement = new DBStatement(DBConnection::getInstance());
                        //echo $benutzerid;
			$statement->executeQuery("SELECT * FROM `benutzer` where rolle = 'Lehrer' and BenutzerID = '$benutzerid'");
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
                                //$this->sprechstundeTag = $row["Sprechstunde_Tag"];
                                //$this->sprechstundeZeit = $row["Sprechstunde_Uhrzeit"];
                                //$this->funktion = $row["Funktion"];
                                //$this->klassenlehrer = $row["Klassenlehrer"];
				return true;
			}
			return false;
		}
                
                public function load($benutzerid) {
			$statement = new DBStatement(DBConnection::getInstance());
                        
			$statement->executeQuery("select benutzer.*,lehrer.Sprechstunde_Tag, lehrer.Sprechstunde_Uhrzeit, Lehrer.Raum, Lehrer.Funktion, lehrer.Klassenlehrer from lehrer left join Benutzer on lehrer.benutzerid = benutzer.benutzerID WHERE benutzer.BenutzerID = '$benutzerid';");
			if ($row = $statement->getNextRow()) {
				$this->benutzerid = $benutzerid;
				$this->benutzername = $row["Benutzername"];
				$this->vorname = $row["Vorname"];
				$this->name = $row["Name"];
				$this->email = $row["Email"];
				$this->telefon = $row["Telefon"];
                                $this->passwort = $row["Passwort"];
				$this->raum = $row["Raum"];
				$this->rolle = $row["Rolle"];
                                $this->sprechstundeTag = $row["Sprechstunde_Tag"];
                                $this->sprechstundeZeit = $row["Sprechstunde_Uhrzeit"];
                                $this->funktion = $row["Funktion"];
                                $this->klassenlehrer = $row["Klassenlehrer"];
                        }
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
		
		public function speichern($benutzerid, $benutzername, $passwort, $vorname, $name, $email, $telefon, $raum, $rolle, $sprechstundeTag, $sprechstundeZeit, $funktion, $klassenlehrer) {			
			//$rolle_id = $this->getRole($rolleName);
			
			$statement = new DBStatement(DBConnection::getInstance());
			
			$query1 = "UPDATE "
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
                        
                        $query2 = "UPDATE "
                                .   "`lehrer` "
                                ."SET "
                                .   "`Sprechstunde_Tag`= '$sprechstundeTag',"
                                .   "`Sprechstunde_Uhrzeit`= '$sprechstundeZeit',"
                                .   "`Raum`= '$raum',"
                                .   "`Funktion`= '$funktion',"
                                .   "`Klassenlehrer`= '$klassenlehrer' "
                                ."WHERE BenutzerID = '$benutzerid';";
                        
                        
                        
			$statement->executeQuery($query1);
                       
                        
                        $statement->executeQuery($query2);
                        
                        if($klassenlehrer = 1) {
                            $query3 = "UPDATE "
                                    .   "`klassenlehrer` "
                                    . "SET "
                                    .   "`KlasseID`=2 "
                                    . "WHERE BenutzerID = '$benutzerid';";
                            $statement->executeQuery($query3);
                        }
			return true;
		}
	}
?>
