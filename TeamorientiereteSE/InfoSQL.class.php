<?php

require_once("DBConnection.class.php");
require_once("Info.class.php");

class InfoSQL extends Info {
  
    public function anlegen($gültigkeitsdatum, $textfeld, $bezeichnung, $benutzerID) {
        $statement = new DBStatement(DBConnection::getInstance());
        $query = "insert into Information (`Bezeichnung`, `BenutzerID`, `Gueltigkeitsdatum`, `Text`) VALUES ('".$bezeichnung."', ".$benutzerID.", '".$gültigkeitsdatum."', '".$textfeld."')";
          $statement->executeQuery($query);
          $sql2="select max(infoid) as infoid from information";
         $statement->executeQuery($sql2);
         $row=$statement->getNextRow();
         return $row['infoid'];
    }

     public function laden($infoid) {
        $statement = new DBStatement(DBConnection::getInstance());

        $statement->executeQuery("SELECT * FROM Information WHERE infoid = $infoid;");
        if ($row = $statement->getNextRow()) {
            $this->infoid = $infoid;
            $this->bezeichnung = $row["Bezeichnung"];
		$this->textfeld = $row["Text"];
		$this->gültigkeitsdatum = $row["Gueltigkeitsdatum"];
		$this->benutzerID = $row["BenutzerID"];
                $this->erstellungsdatum = $row["Erstellungsdatum"];

            return true;
        }
        return false;
    }
    
    public function aendern($infoid, $gültigkeitsdatum, $textfeld, $bezeichnung, $benutzerID) {
        $statement = new DBStatement(DBConnection::getInstance());
        $query = "UPDATE information set Gueltigkeitsdatum = '".$gültigkeitsdatum."', Text = '".$textfeld."', Bezeichnung = '".$bezeichnung."', BenutzerID = $benutzerID, Erstellungsdatum = CURRENT_TIMESTAMP where InfoID= ". $infoid."";
         if ($statement->executeQuery($query)) 
         {
            return true;
        }
        else
        {
        return false;
        }
    }
    
 public function existsSchulinfo ($infoid){
            $statement = new DBStatement(DBConnection::getInstance());

        $sql = "select klasseid from informationklasse where infoid = ".$infoid." ";
             $statement->executeQuery($sql);
        
           $row=$statement->getNextRow();
               if($row['klasseid']==NULL){
                   return true;
               }
               else{
                   return false;
               }
           
        
    }
       
      
        public function infoKlasseCheck($infoid, $klassenid){
            $statement = new DBStatement(DBConnection::getInstance());

        $sql = "select klasseid from informationklasse where infoid = ".$infoid." and klasseid= ".$klassenid."";
             $statement->executeQuery($sql);
        
              if( $row=$statement->getNextRow()){
                return true;
              }
              else 
              {
                  return false;
              }
        }
         
        
    
    public function infoKlasseZuordnen($infoid, $klassenid){
        $statement = new DBStatement(DBConnection::getInstance());

        $sql = "INSERT INTO "
                .   "informationklasse (infoid, klasseid) "
                . "VALUES "
                .   "($infoid,$klassenid)";  
        
              if(  $statement->executeQuery($sql)){
                return true;
              }
              else 
              {
                  return false;
              }
        
    }
    public function deleteInfoKlasseZuordnung($infoid){
          $statement = new DBStatement(DBConnection::getInstance());

        $sql = "Delete from informationklasse where infoid= ".$infoid.""; 
        
              if(  $statement->executeQuery($sql)){
                return true;
              }
              else 
              {
                  return false;
              }
    }
    public function infoLoeschen($infoid){
        
          $statement = new DBStatement(DBConnection::getInstance());

        $sql = "Delete from Information where infoid= ".$infoid.""; 
        
              if(  $statement->executeQuery($sql)){
                return true;
              }
              else 
              {
                  return false;
              }
    }

    

}
