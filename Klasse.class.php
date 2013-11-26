<?php

require_once("DBConnection.class.php");


class Klasse {
   private $klassenId;
   private $jahrgangsstufe;
   private $bezeichnung;
   

   public function getKlassenId(){
       return $this->klassenId;
   }
 public function getJahrgangsstufe(){
       return $this->jahrgangsstufe;
   }
    public function getBezeichnung(){
       return $this->bezeichnung;
   }
   public function load ($klassenID){
       
        $statement = new DBStatement(DBConnection::getInstance());
        $query3="select * from Klasse where KlasseID = ".$klassenID."";
        if( $statement->executeQuery($query3)){
          $row = $statement->getNextRow(); 
          $this->klassenId= $row['KlasseID'];
           $this->jahrgangsstufe= $row['Jahrgangsstufe'];
        $this->bezeichnung = $row['Kuerzel'];
        return true;
        }
        else{
            return false;
        
        }
            
          
        
    
       
   }
    

}
