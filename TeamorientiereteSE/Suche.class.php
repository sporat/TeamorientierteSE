<?php
require_once("SucheSQL.class.php");

class Suche {
    
    private $submitKey = 'suchen';
    
    private $statusText;
        
     
        
    	public function doActions() {
            
		if (array_key_exists($this->submitKey, $_POST)) {
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
                            
                            //$suche = new SucheSQL;
                           // $suche->suchePersonenVornameNachnameEmailBenutzername($rolle, $vorname, $nachname, $email, $benutzername);
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
                            
               
	}
        
	public function getStatusText() {
		return $this->statusText;
	}	
        
        
      
         

	public function __toString() {
            
                if($_REQUEST['contentId'] == 'suche_lehrer') {
                    $form = new Template("SucheNachLehrern.tmpl.html");
                    $form->setValue("[art]", 'lehrer_suchen');
                    $form->setValue("[rolle]", 'lehrer');
                    $form->setValue("[contentId]", 'suche_ergebnis_lehrer');
                }
                else if($_REQUEST['contentId'] == 'suche_eltern') {
                    $form = new Template("SucheNachEltern.tmpl.html");
                    $form->setValue("[art]", 'eltern_suchen');
                } 
                else if($_REQUEST['contentId'] == 'suche_termin') {
                    $form = new Template("SucheNachTerminen.tmpl.html");
                    $form->setValue("[art]", 'termin_suchen');
                } 
                else if($_REQUEST['contentId'] == 'suche_information') {
                    $form = new Template("SucheNachInformationen.tmpl.html");
                    $form->setValue("[art]", 'information_suchen');
                }
                
		 return $form;
				
	}
}
