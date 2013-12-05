<?php
require_once("LehrerInfo.class.php");
require_once("DBStatement.class.php");
require_once("DBConnection.class.php");

class SucheLehrerListe {

	private $lehrer;
	
	public function __construct() {
                if($_POST['art'] = 'lehrer_suchen') {
                        //alle leer
                        if(empty($_POST['vorname']) && empty($_POST['nachname']) && empty($_POST['email']) && empty($_POST['benutzername'])) {
                            $this->statusText = "Sie müssen mindestens ein Feld ausfüllen";
                        }
                        //alle voll
                        else if(!empty($_POST['vorname']) && !empty($_POST['nachname']) && !empty($_POST['email']) && !empty($_POST['benutzername'])) {
                            $rolle = $_POST['rolle'];
                            $benutzername = $_POST['benutzername'];
                            $vorname = $_POST['vorname'];
                            $nachname = $_POST['nachname'];
                            $email = $_POST['email'];
                            
                            $this->lehrer = array();
		
                            $statement = new DBStatement(DBConnection::getInstance());
                            $query = "SELECT * FROM `benutzer` where rolle = '$rolle'
                                      and email like '%$email%'
                                      and vorname like '%$vorname%'
                                      and name like '%$nachname%'
                                      and benutzername like '%$benutzername%'";
                            $statement->executeQuery($query);
                            
                            while ($row = $statement->getNextRow()) {
                                    $lehrer = new LehrerInfo();
                                    $lehrer->ladenSuche($row["BenutzerID"]);

                                    // Mit array_push werden neue Werte am Ende des Arrays angefügt 
                                    array_push($this->lehrer, $lehrer);
                                    
		}
                        }
                        //vorname leer
                        else if(empty($_POST['vorname']) && !empty($_POST['nachname']) && !empty($_POST['email']))
                            $nachname = $_POST['nachname'];
                            $email = $_POST['email'];
                            //sql3                      
                        }
                        //email leer
                        else if(!empty($_POST['vorname']) && !empty($_POST['nachname']) && empty($_POST['email'])) {
                            $vorname = $_POST['vorname'];
                            $nachname = $_POST['nachname'];
                            //sql4
                        }
                        //nachname leer
                        else if(!empty($_POST['vorname']) && empty($_POST['nachname']) && !empty($_POST['email'])) {
                            $vorname = $_POST['vorname'];
                            $email = $_POST['email'];
                            //sql6
                        }
                        //email,nachname leer
                        else if(!empty($_POST['vorname']) && empty($_POST['nachname']) && empty($_POST['email'])) {
                            $vorname = $_POST['vorname'];
                            //sql7
                        }
                        //vorname,email leer
                        else if(empty($_POST['vorname']) && !empty($_POST['nachname']) && empty($_POST['email'])) {
                            $nachname = $_POST['nachname'];
                            //8
                        }
                        //vorname,nachname leer
                        else if(empty($_POST['vorname']) && empty($_POST['nachname']) && !empty($_POST['email'])) {
                            $email = $_POST['email'];
                            //sql2
                        }
                        //email,benutzername leer
                        else if(!empty($_POST['vorname']) && !empty($_POST['nachname']) && empty($_POST['email']) && empty($_POST['benutzername'])) {
                            $vorname = $_POST['vorname'];
                            $nachname = $_POST['nachname'];
                            //sql2
                        }
                        //vorname,benutzername leer
                        else if(empty($_POST['vorname']) && !empty($_POST['nachname']) && !empty($_POST['email']) && empty($_POST['benutzername'])) {
                            $email = $_POST['email'];
                            $nachname = $_POST['nachname'];
                            //sql2
                        }
                        //nachname,benutzername leer
                        else if(empty($_POST['vorname']) && empty($_POST['nachname']) && !empty($_POST['email']) && empty($_POST['benutzername'])) {
                            $vorname = $_POST['vorname'];
                            $nachname = $_POST['nachname'];
                            //sql2
                        }
		
	}

	public function getLehrer() {
		// korrekter Weise müsste hier das Array noch kopiert werden
		return $this->lehrer;
	}
	
}
