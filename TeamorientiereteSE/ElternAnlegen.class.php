<?php
    require_once 'ElternSQL.class.php';
    require_once ("SchuelerSQL.class.php");


/**adsfdfgsdfgg
 * 
 Hier wird behandelt, wie sich Eltern am System registrieren können
 
 * 
 */
class ElternAnlegen {
    
    private $submitKey = "eltern_registrieren_am_system";
    private $statusText;
    public static $CONTENT_ID;
    private $benutzername; 
    private $passwort;
    private $name;
    private $vorname;
    private $email;
    private $telefon;
    private $mitteilungsweg;
    private $status;
    private $zugangsschlüssel;
    private $form;
                   
    
        public function fill(){
                $this->form = new Template("ElternAnlegen.tmpl.html");
		
		
		$this->form->setvalue("[benutzername]","");
		$this->form->setvalue("[passwort]", $this->passwort);
		$this->form->setvalue("[name]",$this->name);
		$this->form->setvalue("[vorname]", $this->vorname);
		$this->form->setvalue("[email]",$this->email);
                $this->form->setvalue("[telefon]",$this->telefon);
                print $this->form;
		
		
        }
    	public function doActions() {
            
		if (array_key_exists($this->submitKey, $_POST)) {
                    $this->benutzername = $_POST['benutzername'];
                    $this->passwort = $_POST['passwort'];
                    $this->name = $_POST['name'];
                    $this->vorname = $_POST['vorname'];
                    $this->email = $_POST['email'];
                    $this->telefon = $_POST['telefon'];
                    $this->mitteilungsweg = $_POST['weg'];
                    $this->status = 0;
                    
                    //$datenbank = $_POST['datenbank'];
                    $this->zugangsschlüssel = $_POST['zugangsschlüssel'];
                    $rolle='Eltern';
                    
                    $elternsql = new ElternSQL();
                    
                    //correctKey soll überprüfen, ob ein Kind mit dem eingegebenen Schlüssel existiert....
                    if(!$elternsql->load($this->benutzername)){
                    if($elternsql->correctKey($this->zugangsschlüssel))
                    {   
                       
                        $elternsql->anlegen($this->benutzername, $this->passwort, $this->name, $this->vorname, $this->email, $this->telefon, $this->mitteilungsweg, $rolle, $this->status);
                        $schuelersql= new SchuelerSQL();
                        
                        $schuelersql->beziehung_kind_eltern($this->zugangsschlüssel,$this->benutzername);
                        $schuelersql->zugangsschluessel_loeschen($this->zugangsschlüssel,$this->benutzername);
                    }
                    
                    else//hier fehlt noch eine Statusausgabe...
                    {  print ("Falscher Zugangsschlüssel");
                        $this->status=1;
                        $elternsql->anlegen($this->benutzername, $this->passwort, $this->name, $this->vorname, $this->email, $this->telefon, $this->mitteilungsweg, $rolle, $this->status);
                        $_REQUEST['contentId']="kind_hinzufuegen";
                        $_REQUEST['benutzername']= $this->benutzername;
                        
                        
                    }
		}
                else
                    {
                    //status
                    print "Benutzername bereits vergeben.";
                    $this->fill();
                
	}
        }
}
        
	public function getStatusText() {
		return $this->statusText;
	}	
        
	public function __toString() {
		$this->form = new Template("ElternAnlegen.tmpl.html");
                $this->form->setvalue("[benutzername]","");
		$this->form->setvalue("[passwort]", "");
		$this->form->setvalue("[name]","");
		$this->form->setvalue("[vorname]", "");
		$this->form->setvalue("[email]","");
                $this->form->setvalue("[telefon]","");
                 return $this->form->__toString();
                
                
                }
				
	}

