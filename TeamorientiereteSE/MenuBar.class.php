<?php
    //require_once("Logout.class.php");

    class  MenuBar {

        public function __toString() {

            //$userLogout= new UserLogout();

            $menuBar = "<div id='menueBar'>";
            $menuBar =        "<ul id ='Navigation'>";
            $menuBar .=     "<li><a href='index.php?contentId='>Profile</a></li>";
            $menuBar .=     "<li><a href='index.php?contentId=suche'>Suche</a></li>";
            $menuBar .=     "<li><a href='index.php?contentId='>Postfach</a></li>";
            $menuBar .=     "<li><a href='index.php?contentId='>Beispiel1</a></li>";
            $menuBar .=     "<li><a href='index.php?contentId='>Beispiel2</a></li>";
            $menuBar .= "</ul>";   
           
            $menuBar .= "</div>";
            
            return $menuBar;
        }
    }
?>