<?php
    require_once ("LehrerSQL.class.php");

	
	class LehrerAnlegen {
public $benutzername;
public $passwort;
    public $name;
                    public $vorname;
                    public $email;
                   public $telefon;
                    public $raum;
                    public $status;
                    public $rolle;
                    public $sprechstundeWochentag;
                    public $sprechstundeUhrzeit;
                    public $funktion;
                    public $klassenlehrer;
	public $form;
/**
 * Description of Verwaltung
 In dieser Klasse wird das Anlegen, Ändern und Löschen von Admins behandelt
 
 * @author Basti
 */

    
    private $submitKey = "lehrer_anlegen_bestaetigen";
    private $statusText;
    
    	public function doActions() {
            
		if (array_key_exists($this->submitKey, $_POST)) {
                    $this->benutzername = $_POST['benutzername'];
                    $this->passwort = $_POST['passwort'];
                    $this->name = $_POST['name'];
                    $this->vorname = $_POST['vorname'];
                    $this->email = $_POST['email'];
                    $this->telefon = $_POST['telefon'];
                    $this->raum = $_POST['raum'];
                    $this->status = 0;
					//0 ~ aktiviert; 1~nicht aktiviert;
                    //$datenbank = $_POST['datenbank'];
                    $this->rolle = $_POST['rolle'];
                    $this->sprechstundeWochentag = $_POST['wochentag'];
                    $this->sprechstundeUhrzeit = $_POST['zeit'];
                    $this->funktion = $_POST['funktion'];
                    $this->klassenlehrer =  $_POST['klassenlehrer'];
                    
                    $lehrerAnlegen = new LehrerSQL();
					if ($lehrerAnlegen->exists($this->benutzername))
					{
					$this->statusText="Benutzername schon vorhanden!";
					$this->fill();
					}
					else {
                    $lehrerAnlegen->anlegen($this->benutzername, $this->passwort, $this->name, $this->vorname, $this->email, $this->telefon, $this->raum, $this->rolle, $this->sprechstundeWochentag, $this->sprechstundeUhrzeit, $this->funktion, $this->klassenlehrer, $this->status);
					$this->statusText="Lehrer " .$this->name. ", " .$this->vorname. " erfolgreich angelegt!";
					}
		} 
	}
        
	public function getStatusText() {
		return $this->statusText;
	}	
    public function fill() {
		$this->form = new Template("LehrerAnlegen.tmpl.html");
	$this->form->setValue("[benutzername]", "");
    $this->form->setValue("[passwort]", $this->passwort);
    $this->form->setValue("[name]", $this->name);
    $this->form->setValue("[vorname]", $this->vorname);
    $this->form->setValue("[email]", $this->email);
    $this->form->setValue("[telefon]", $this->telefon);
    $this->form->setValue("[raum]", $this->raum);
    $this->form->setValue("[rolle]", $this->rolle);
    $this->form->setValue("[wochentag]", $this->sprechstundeWochentag);
    $this->form->setValue("[zeit]", $this->sprechstundeUhrzeit);
    $this->form->setValue("[funktion]", $this->funktion);
    $this->form->setValue("[klassenlehrer]", $this->klassenlehrer);
		print $this->form;
	}	
	
	public function __toString() {
		$this->form = new Template("LehrerAnlegen.tmpl.html");
	$this->form->setValue("[benutzername]", "");
    $this->form->setValue("[passwort]", "");
    $this->form->setValue("[name]", "");
    $this->form->setValue("[vorname]", "");
    $this->form->setValue("[email]", "");
    $this->form->setValue("[telefon]", "");
    $this->form->setValue("[raum]", "");
    $this->form->setValue("[rolle]", "");
    $this->form->setValue("[wochentag]", "");
    $this->form->setValue("[zeit]", "");
    $this->form->setValue("[funktion]", "");
    $this->form->setValue("[klassenlehrer]", "");
		return $this->form->__toString();
				
	}
}
