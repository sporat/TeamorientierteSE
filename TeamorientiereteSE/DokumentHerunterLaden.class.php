<?php

require_once ("DBStatement.class.php");
require_once ("DBConnection.class.php");

class DokumentHerunterLaden {
    
    private $statusText;
    
    public function doAction() {
        if(array_key_exists("id", $_REQUEST) and $_REQUEST['contentId']== "dokument_herunterladen_formular")
        {
            $dokumentid = $_REQUEST["id"];
            $dateiname = $_REQUEST["name"];
            $this->statusText = "Datei erfolgreich heruntergeladen.";
        }
        
    }
    
    public function getStatusText () {
        return $this->statusText;
    }
}

