<?php

require_once ("DBStatement.class.php");
require_once ("DBConnection.class.php");

class ElternDokumentEigenschaften {
    
    public $dokumentid;
public $dateiname;
public $fachid;
public $bezeichnung;
public $klasseid;
public $kuerzel; 
public $jahrgangsstufe;
public $kindvorname;
public $kindid;
public $dokBenutzerid;

public function __construct($dokumentid = null, $dateiname = "", $dokBenutzerid = null, $fachid = null, $bezeichnung = "", $klasseid =null, $kuerzel="", $jahrgangsstufe="", $kindvorname = "", $kindid = null) {
                        $this->dokumentid = $dokumentid;
			$this->dateiname = $dateiname;
                        $this->dokBenutzerid= $dokBenutzerid;
                        $this->fachid = $fachid;
			$this->bezeichnung = $bezeichnung;
			$this->klasseid = $klasseid;
			$this->kuerzel = $kuerzel;
			$this->jahrgangsstufe = $jahrgangsstufe;
                        $this->kindvorname = $kindvorname;
			$this->kindid = $kindid; 
                                                
		}

public function getDokumentID() {
    return $this->dokumentid;
}
public function getDokumentBenutzerID() {
    return $this->dokBenutzerid;
}
public function getDateiname() {
    return $this->dateiname;
}
public function getFachID() {
    return $this->fachid;
}
public function getBezeichnung() {
    return $this->bezeichnung;
}
public function getKlasseID() {
    return $this->klasseid;
}
public function getKuerzel() {
    return $this->kuerzel;
}
public function getJahrgangsstufe() {
    return $this->jahrgangsstufe;
}
public function getKindVorname() {
    return $this->kindvorname;
}
public function getKindID() {
    return $this->kindid;
}

public function laden($dokumentid, $kindid) {
    $statement = new DBStatement(DBConnection::getInstance());
      if (User::getInstance()->getBenutzerId())
 {
   $benutzerid=  User::getInstance()->getBenutzerId(); 
 }
 else
 {
     $benutzerid=1;
 }
    $query = "SELECT dokument.dokumentid as dokumentid, dokument.dateiname as dateiname, 
        dokument.benutzerid as dbenutzerid, fach.fachid as fachid, fach.Bezeichnung as bezeichnung, 
        klasse.klasseid as klasseid, klasse.kuerzel as kuerzel, klasse.jahrgangsstufe as jahrgang, 
        Kind.Vorname as vorname, Kind.kindid as kindid FROM dokument, fach, dokumentklasse, klasse, Kind 
where dokument.fachid = fach.fachid
and dokument.dokumentid = dokumentklasse.dokumentid
and dokumentklasse.klasseid = klasse.klasseid
and klasse.klasseid = kind.klasseid
and Kind.benutzerid = ".$benutzerid."
and Kind.kindid = ".$kindid."
and Dokument.dokumentid = ".$dokumentid."";

 $statement->executeQuery($query);
 if ($row = $statement->getNextRow()) {
     $this->dokumentid=$dokumentid;
$this->dateiname = $row["dateiname"];
$this->fachid = $row["fachid"];
$this->bezeichnung = $row["bezeichnung"];
$this->dokBenutzerid = $row["dbenutzerid"];
$this->klasseid = $row["klasseid"];
$this->kuerzel = $row["kuerzel"]; 
$this->jahrgangsstufe = $row["jahrgang"];
$this->kindvorname = $row["vorname"];
$this->kindid = $kindid;
                     return true;
        }
        
            return false;
}

public function ohneFachOhneKlasseladen($dokumentid) {
    $statement = new DBStatement(DBConnection::getInstance());
 
    $query = "SELECT dokument.dokumentid as dokumentid, dokument.dateiname as dateiname, dokument.benutzerid as benutzerid 
     FROM dokument, dokumentklasse
where dokument.fachid is null
and dokumentklasse.klasseid is null
and Dokument.dokumentid = ".$dokumentid."
         order by Dokument.dateiname";

 $statement->executeQuery($query);
 if ($row = $statement->getNextRow()) {
     $this->dokumentid=$dokumentid;
$this->dateiname = $row["dateiname"];
$this->dokBenutzerid = $row["benutzerid"];

                     return true;
        }
        
            return false;
}

public function ohneFachladen ($dokumentid) {
    $statement = new DBStatement(DBConnection::getInstance()); 
         if (User::getInstance()->getBenutzerId())
 {
   $benutzerid=  User::getInstance()->getBenutzerId(); 
 }
 else
 {
     $benutzerid=1;
 }
    $query1 = "SELECT Dokument.dokumentid as dokumentid, dokument.dateiname as dateiname, dokument.benutzerid as dbenutzerid, 
        dokumentklasse.klasseid, klasse.jahrgangsstufe as jahrgang, klasse.kuerzel as kuerzel,  
        kind.vorname as vorname
     FROM dokument, dokumentklasse, klasse, kind
where dokument.fachid is null
and dokument.dokumentid = dokumentklasse.dokumentid
and dokumentklasse.klasseid= kind.klasseid
and kind.benutzerid = ".$benutzerid."
    and Dokument.dokumentid = ".$dokumentid."
         order by Kind.vorname, dokument.dateiname";
     $statement->executeQuery($query1);
 if ($row = $statement->getNextRow()) {
     $this->dokumentid=$dokumentid;
$this->dateiname = $row["dateiname"];
$this->dokBenutzerid = $row["dbenutzerid"];
$this->kuerzel = $row["kuerzel"]; 
$this->jahrgangsstufe = $row["jahrgang"];
$this->kindvorname = $row["vorname"];
                     return true;
 }
 return false;
}

public function ohneKlasseladen($dokumentid) {
    $statement = new DBStatement(DBConnection::getInstance()); 
         if (User::getInstance()->getBenutzerId())
 {
   $benutzerid=  User::getInstance()->getBenutzerId(); 
 }
 else
 {
     $benutzerid=1;
 }
    $query2 = "SELECT Dokument.dokumentid as dokumentid, dokument.dateiname as dateiname, dokument.benutzerid as benutzerid,
        dokumentklasse.klasseid, dokument.fachid as fachid, fach.bezeichnung as bezeichnung
     FROM dokument, dokumentklasse, fach
where dokumentklasse.klasseid is null
and dokument.fachid = fach.fachid
and Dokument.dokumentid = ".$dokumentid."
         order by Dokument.dateiname";
//vereinfachend wird davon ausgegangen, dass ein Kind in allen möglichen Fächer der Schule unterrichtet wird
    // evtl einführung der tabelle fachklasse, in der steht welche klasse welche fächer hat; bisher, aufwendig über lehrerfachklasse mit lehrerfachid und klasseid!!
    $statement->executeQuery($query2);
 if ($row = $statement->getNextRow()) {
     $this->dokumentid=$dokumentid;
$this->dateiname = $row["dateiname"];
$this->fachid = $row["fachid"];
$this->bezeichnung = $row["bezeichnung"];
$this->dokBenutzerid = $row["benutzerid"];

                     return true;
}
return false;
}
}

