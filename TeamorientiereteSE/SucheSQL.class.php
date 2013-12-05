<?php
require_once("DBConnection.class.php");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SucheSQL
 *
 * @author Basti
 */
class SucheSQL {
    //put your code here
    public function suchePersonenVornameNachnameEmailBenutzername($rolle, $vorname, $nachname, $email, $benutzername) {
        $statement = new DBStatement(DBConnection::getInstance());
        $query = "SELECT * FROM `benutzer` where rolle = '$rolle'
                  and email like '%$email%'
                  and vorname like '%$vorname%'
                  and name like '%$nachname%'
                  and benutzername like '%$benutzername%'";
        //echo $query;
        
    }
}
