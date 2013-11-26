<?php
    require_once 'ElternSQL.class.php';
    require_once ("SchuelerSQL.class.php");
	require_once ("ElternEigenschaften.class.php");

/**
 * 
 Hier wird behandelt, wie sich Eltern am System ändern können
 
 * 
 */
class ElternAendern {
    
    private $submitKey = "eltern_aendern";
    private $statusText;
    public static $CONTENT_ID;
    private $benutzerid;
	private $benutzername; 
    private $passwort;
    private $name;
    private $vorname;
    private $email;
    private $telefon;
    private $mitteilungsweg;
    private $status;
	private $rolle;
	private $eltern;
	private $elternsql;

	public function getEltern() {
		return $this->eltern;
	}

	public function setEltern($eltern) {
		$this->eltern = $eltern;
	}
    	public function doActions() {
            $this->eltern= new ElternEigenschaften();
			  $this->elternsql = new ElternSQL();
					if (!$this->elternsql->load($this->benutzername)) {
				
				$this->eltern = new ElternInfo($this->benutzerid, $this->benutzername, $this->passwort, $this->vorname, $this->name, $this->email, $this->telefon, $this->rolle, $this->status, $this->mitteilungsweg);
			}
		if (array_key_exists($this->submitKey, $_POST)) {
					$this->benutzerid = $_POST['benutzerid'];
                    $this->benutzername = $_POST['benutzername'];
                    $this->passwort = $_POST['passwort'];
                    $this->name = $_POST['name'];
                    $this->vorname = $_POST['vorname'];
                    $this->email = $_POST['email'];
                    $this->telefon = $_POST['telefon'];
                    $this->mitteilungsweg = $_POST['weg'];
                    $this->status = 0;
                    $this->rolle="Eltern";
                    
					
                    $this->elternsql = new ElternSQL();
					if (!$this->elternsql->load($this->benutzername)) {
				
				$this->eltern = new ElternInfo($this->benutzerid, $this->benutzername, $this->passwort, $this->vorname, $this->name, $this->email, $this->telefon, $this->rolle, $this->status, $this->mitteilungsweg);
			}
                    $this->elternsql->elternAendern($this->benutzerid, $this->benutzername, $this->name, $this->vorname, $this->passwort, $this->email, $this->telefon, $this->mitteilungsweg);
					$this->statusText = "Eltern '".$this->name."' wurden erfolgreich geändert.";
                    //correctKey soll überprüfen, ob ein Kind mit dem eingegebenen Schlüssel existiert....

        }      
          elseif (array_key_exists("id", $_REQUEST)) {
			// Model instanziieren und laden
			$this->eltern = new ElternInfo();
			$this->eltern->laden($_REQUEST["id"]);
		}          
		}
      


        
	public function getStatusText() {
		return $this->statusText;
	}	
        
	public function __toString() {
		$form = new Template("ElternAendern.tmpl.html");
		$form->setvalue("[benutzerid]",$this->eltern->getBenutzerID());
        $form->setvalue("[benutzername]",$this->eltern->getBenutzername());
		$form->setvalue("[passwort]", $this->eltern->getPasswort());
		$form->setvalue("[name]",$this->eltern->getName());
		$form->setvalue("[vorname]", $this->eltern->getVorname());
		$form->setvalue("[email]",$this->eltern->getEmail());
        $form->setvalue("[telefon]",$this->eltern->getTelefon());

                 return $form->__toString();
        }
				
	}

