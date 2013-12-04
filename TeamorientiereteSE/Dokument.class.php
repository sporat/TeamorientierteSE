<?php
require_once ("DBStatement.class.php");
require_once("DBConnection.class.php");
class Dokument {
    private $dokumentid;
    private $typ;
    private $pfad;
    private $benutzerid;
    private $fachid;
    private $dateiname;
    
    public function getDokumentId() {
        return $this->dokumentid;
    }
     public function getTyp() {
        return $this->typ;
    }
     public function getPfad() {
        return $this->pfad;
    }
     public function getBenutzerId() {
        return $this->benutzerid;
    }
     public function getFachId() {
        return $this->fachid;
    }
     public function getDateiname() {
        return $this->dateiname;
    }
    public function laden($dokumentid) {
        $statement = new DBStatement(DBConnection::getInstance());

        $statement->executeQuery("SELECT * FROM Dokument WHERE dokumentid = $dokumentid;");
        if ($row = $statement->getNextRow()) {
            $this->dokumentid = $dokumentid;
            $this->typ = $row["Typ"];
		$this->pfad = $row["Pfad"];
		$this->benutzerid = $row["BenutzerID"];
		$this->fachid = $row["FachID"];
                $this->dateiname = $row["Dateiname"];

            return true;
        }
        return false;
    }
    public function upload($pfad, $typ, $name, $fachid) {
        $statement = new DBStatement(DBConnection::getInstance());
        $query = "INSERT INTO Dokument (Pfad, Typ, Dateiname, BenutzerID, FachID) VALUES ('".$pfad."', '".$typ."', '".$name."', ".User::getInstance()->getBenutzerId().", ".$fachid.") ";
        
        $statement->executeQuery($query);
        $sql = "select max(dokumentid) as dokumentid from dokument";
       $statement->executeQuery($sql);
       $row = $statement->getNextRow();
       return $row["dokumentid"];
    }
    public function dokumentKlasseZuordnen($dokumentid, $klassenid) {
        $statement = new DBStatement(DBConnection::getInstance());
        $query = "INSERT INTO dokumentklasse (dokumentid, klasseid) VALUES (".$dokumentid.", ".$klassenid.")";
        if ($statement->executeQuery($query))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
   /* public function dokumentklassegetKlassenId($dokumentid) {
        $statement = new DBStatement(DBConnection::getInstance());

        $statement->executeQuery("SELECT * FROM dokumentklasse WHERE dokumentid = $dokumentid;");
        if ($row = $statement->getNextRow()) {
           return $row["KlasseID"];
	
        }
    }*/
}

