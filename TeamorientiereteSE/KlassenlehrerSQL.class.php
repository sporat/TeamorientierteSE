<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KlassenlehrerSQL
 *
 * @author Basti
 */
class KlassenlehrerSQL {
    
    public function setKlassenlehrerJahrgangsstufe($benutzerid) {
        $statement = new DBStatement(DBConnection::getInstance());
        $query = "select klasse.jahrgangsstufe from klassenlehrer 
                  left join klasse on klassenlehrer.klasseid = klasse.klasseid
                  where benutzerid = '$benutzerid'";
        $statement->executeQuery($query);
        $erg = mysql_query($query);
        
        return mysql_result($erg,0,0);
    }
    
    public function setKlassenlehrerKlasse($benutzerid) {
        $statement = new DBStatement(DBConnection::getInstance());
        $query = "select KlasseID from Klassenlehrer where BenutzerID = '$benutzerid'";
        $statement->executeQuery($query);
        $erg = mysql_query($query);
        
        return mysql_result($erg,0,0);
        
    }
    
    public function SchuelerZuKlassezuordnen($kindid, $klasseid) {
            
        $statement = new DBStatement(DBConnection::getInstance());
        $query = "UPDATE Kind SET KlasseID = $klasseid WHERE KindID = $kindid";
        $statement->executeQuery($query);
    }
}
