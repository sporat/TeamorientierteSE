<?php

require_once("DBConnection.class.php");
require_once("DBStatement.class.php");

class User {

    private $loggedIn;
    private $benutzerid;
    private $benutzername;
    private $passwort;
    private $name;
    private $vorname;
    private $email;
    private $telefon;
    private $rolle;
    // TODO hier m�ssen alle Attribute, die ein Benutzer ben�tigt, erg�nzt werden

    private static $instance; // Singleton-Instanz der Klasse

    /**
     * Gibt das Singleton-Objekt zur�ck
     *
     * @return User-Singleton-Objekt
     */

    public static function getInstance() {

        // Pr�fen, ob bereits eine Instanz angelegt vorhanden ist
        if (!isset(self::$instance)) {
            // Anlegen einer Singleton-Instanz
            self::$instance = new User();
        }

        return self::$instance;
    }

    /**
     * Setzt das Singleton-Objekt
     *
     * Wird vorwiegend nach dem Auslesen eines User-Objektes aus der Session ben�tigt
     *
     * @param User $user Setzt das als Singleton-Objekt zu setzende User-Objekt
     */
    public static function setAsInstance(User $user) {
        self::$instance = $user;
    }

    public function __construct() {
        $this->loggedIn = false;
    }

    /**
     * Meldet einen Benutzer an
     *
     * @return true, wenn die Anmeldung erfolgreich war, sonst false
     */
    public function login($login, $pass) {

        $statement = new DBStatement(DBConnection::getInstance());
        $query1 = "select * from benutzer where benutzername = '" . $login . "' and passwort = '" . $pass . "'";
        $statement->executeQuery($query1);
        if ($row = $statement->getNextRow()) {
            $query = "select status from benutzer where benutzername = '" . $login . "' and passwort = '" . $pass . "'";
            $statement->executeQuery($query);
            $erg = mysql_query($query);
            $status = mysql_result($erg, 0);

            if ($row = $statement->getNextRow() and $status == 0) {
                $this->loggedIn = true;
            } else { //Fall Status "deaktiviert"
                $this->loggedIn = false;
                $this->rolleid = "";
                $this->rolle = "";
                $this->login = "";
                session_unset();
            }
        } else { //Fall Benutzername oder PW falsch
            $this->loggedIn = false;
            $this->rolleid = "";
            $this->rolle = "";
            $this->login = "";
            session_unset();
        }

        return $this->loggedIn;
    }

    public function logout() {
        $this->loggedIn = false;
        $this->rolleid = "";
        $this->rolle = "";
        $this->login = "";

        return $this->loggedIn;
    }

    public function isLoggedIn() {
        return $this->loggedIn;
    }

    /**
     * L�d den Benutzer
     *
     * @return true, wenn der Benutzer geladen werden konnte, sonst false
     */
    public function load($login, $pass) {
        $statement = new DBStatement(DBConnection::getInstance());

        $query = "select * from benutzer where benutzername = '" . $login . "' and passwort = '" . $pass . "'";
        $statement->executeQuery($query);
        if ($row = $statement->getNextRow()) {
            $this->benutzerid = $row['BenutzerID'];
            $this->benutzername = $row['Benutzername'];
            $this->passwort = $row['Passwort'];
            $this->name = $row['Name'];
            $this->vorname = $row['Vorname'];
            $this->email = $row['Email'];
            $this->telefon = $row['Telefon'];
            $this->rolle = $row['Rolle'];
            return true;
        } else
            session_unset();
        return false;
    }
    public function laden($benutzername) {
        $statement = new DBStatement(DBConnection::getInstance());

        $query = "select * from benutzer where benutzername = '" . $benutzername .  "'";
       
        $statement->executeQuery($query);
        if ($row = $statement->getNextRow()) {
            $this->benutzerid = $row['BenutzerID'];
            $this->benutzername = $row['Benutzername'];
            $this->passwort = $row['Passwort'];
            $this->name = $row['Name'];
            $this->vorname = $row['Vorname'];
            $this->email = $row['Email'];
            $this->telefon = $row['Telefon'];
            $this->rolle = $row['Rolle'];
        return true;
        }
        }

    // TODO hier m�ssen die Getter und Setter der Attribute ersetzt werden
    public function getRole() {
        if ($this->rolle == "Systemadministrator") {
            $this->rolle = "Systemadministrator";
        }
        if ($this->rolle == "Verwaltung") {
            $this->rolle = "Verwaltung";
        }
        if ($this->rolle == "Eltern") {
            $this->rolle = "Eltern";
        }
        if ($this->rolle == "Lehrer") {
            $this->rolle = "Lehrer";
        }
        if ($this->rolle == "Klassenlehrer") {
            $this->rolle = "Klassenlehrer";
        }

        return $this->rolle;
    }

    public function passwortspeichern($benutzername, $passwort) {
        //$rolle_id = $this->getRole($rolleName);

        $statement = new DBStatement(DBConnection::getInstance());

        $sql = "UPDATE "
                . "`benutzer` "
                . "SET "
                . "`Passwort`= '$passwort'"
                . " WHERE Benutzername = '$benutzername'";

        $statement->executeQuery($sql);
    }

    public function getBenutzerId() {
        return $this->benutzerid;
    }
    public function getTelefon() {
        return $this->telefon;
    }

    public function getBenutzername() {
        return $this->benutzername;
    }
public function getEmail() {
        return $this->email;
    }
    public function getPasswort() {
        return $this->passwort;
    }
    public function getName() {
        return $this->name;
    }
    public function getVorname() {
        return $this->vorname;
    }
    public function getuser() {
        return $this->user;
    }

}

?>