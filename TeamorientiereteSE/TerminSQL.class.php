<?php

require_once("DBConnection.class.php");


class TerminSQL {
    
    
    public function anlegen($beschreibung, $ort, $infoschreiben, $verantwortlicher, $benutzernummer, $datum, $uhrzeit) {
       

        $statement = new DBStatement(DBConnection::getInstance());

        $sql = "INSERT INTO "
                .   "termin (`BenutzerID`, Beschreibung, Ort, infoschreiben, Verantwortlicher, Datum, Uhrzeit) "
                . "VALUES "
                .   "($benutzernummer, '$beschreibung', '$ort', '$infoschreiben', '$verantwortlicher', '$datum', '$uhrzeit')";  
                $statement->executeQuery($sql);
         $sql2="select max(terminid) as terminid from termin";
         $statement->executeQuery($sql2);
         $row=$statement->getNextRow();
         return $row['terminid'];
        
    }
     public function aendern($beschreibung, $ort, $infoschreiben, $verantwortlicher, $benutzernummer, $datum, $uhrzeit, $terminid) {
       

        $statement = new DBStatement(DBConnection::getInstance());

        $sql = "update "
                .   "termin set BenutzerID = $benutzernummer, Beschreibung='$beschreibung', Ort= '$ort', infoschreiben ='$infoschreiben', Verantwortlicher ='$verantwortlicher', Datum='$datum', Uhrzeit='$uhrzeit', Einstellungsdatum = CURRENT_TIMESTAMP where terminid=$terminid";  
        print $sql;
                if($statement->executeQuery($sql)){
                    return true;
                }
                else{
                    return false;
                }
     }
       public function existsSchultermin ($terminid){
            $statement = new DBStatement(DBConnection::getInstance());

        $sql = "select klasseid from klassentermin where terminid = ".$terminid." ";
             $statement->executeQuery($sql);
        
           $row=$statement->getNextRow();
               if($row['klasseid']==NULL){
                   return true;
               }
               else{
                   return false;
               }
           
        
    }
       
      
        public function terminKlasseCheck($terminid, $klassenid){
            $statement = new DBStatement(DBConnection::getInstance());

        $sql = "select klasseid from klassentermin where terminid = ".$terminid." and klasseid= ".$klassenid."";
             $statement->executeQuery($sql);
        
              if( $row=$statement->getNextRow()){
                return true;
              }
              else 
              {
                  return false;
              }
        }
         
        
    
    public function terminKlasseZuordnen($terminid, $klassenid){
        $statement = new DBStatement(DBConnection::getInstance());

        $sql = "INSERT INTO "
                .   "klassentermin (terminid, klasseid) "
                . "VALUES "
                .   "($terminid,$klassenid)";  
        
              if(  $statement->executeQuery($sql)){
                return true;
              }
              else 
              {
                  return false;
              }
        
    }
    public function deleteTerminKlasseZuordnung($terminid){
          $statement = new DBStatement(DBConnection::getInstance());

        $sql = "Delete from Klassentermin where terminid= ".$terminid.""; 
        
              if(  $statement->executeQuery($sql)){
                return true;
              }
              else 
              {
                  return false;
              }
    }

    

}
