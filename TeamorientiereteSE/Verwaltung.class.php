<?php

require_once 'VerwaltungSQL.class.php';

/**
 * Description of Verwaltung
  In dieser Klasse wird das Anlegen, Ändern und Löschen von Admins behandelt

 * @author Basti
 */
class Verwaltung extends User {

    private $submitKey = "admin_anlegen_bestaetigen";
    private $statusText;
    private $benutzername;
    private $passwort;
    private $name;
    private $vorname;
    private $email;
    private $telefon;
    private $form;
    private $rolle;
    private $datenbank;
    

    public function fill() {
        $this->form = new Template("AdminAnlegen.tmpl.html");
        $this->form->setvalue("[benutzername]", "");
        $this->form->setvalue("[passwort]", $this->passwort);
        $this->form->setvalue("[name]", $this->name);
        $this->form->setvalue("[vorname]", $this->vorname);
        $this->form->setvalue("[email]", $this->email);
        $this->form->setvalue("[telefon]", $this->telefon);
        $this->form->setValue("[rolle]", $this->rolle);
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

            $this->datenbank = $_POST['datenbank'];
            $this->rolle = $_POST['rolle'];

            $verwaltungSQL = new VerwaltungSQL();
            if (!$verwaltungSQL->exists($this->benutzername)) {
             $verwaltungSQL->anlegen($this->benutzername, $this->passwort, $this->name, $this->vorname, $this->email, $this->telefon, $this->rolle);
            $this->statusText = "Der Benutzer $this->benutzername wurde erfolgreich angelegt";
            
            }
               
            else {
                $this->statusText= "Benutzername bereits vergeben.";
                $this->fill();
            }
        }
    }

    public function getStatusText() {
        return $this->statusText;
    }

    public function __toString() {
        $this->form = new Template("AdminAnlegen.tmpl.html");
        $this->form->setvalue("[benutzername]", "");
        $this->form->setvalue("[passwort]", "");
        $this->form->setvalue("[name]", "");
        $this->form->setvalue("[vorname]", "");
        $this->form->setvalue("[email]", "");
        $this->form->setvalue("[telefon]", "");
        return $this->form->__toString();
    }

}
