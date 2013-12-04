<?php
require_once ("DBConnection.class.php");
require_once ("DBStatement.class.php");
class Nachrichten {
    private $text;
    private $empfaenger;
    private $betreff;
    private $datum;//datetime!
    private $benutzerId;//aktueller User
    
}