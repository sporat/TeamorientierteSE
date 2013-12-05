<?php
    //require_once("Logout.class.php");

    class  MenuBar {

        public function __toString() {

            //$userLogout= new UserLogout();

            $menuBar = "<div id='Navigation'><ul>";
      //      $menuBar =	"<ul id ='Navigation'>";
			$menuBar .="	<li>Profile";
			$menuBar .="		<ul>";
                        $menuBar .="			<li><a href='index.php?contentId='>Lehrerprofile</a></li>";
			$menuBar .="     		<li><a href='index.php?contentId='>Schulprofil</a></li>";
			$menuBar .="		</ul>";
			$menuBar .="	</li>";
			$menuBar .="	<li>Suche";
			$menuBar .="		<ul>";			
                        $menuBar .="			<li><a href='index.php?contentId=suche_lehrer'>nach Lehrern</a></li>";
			$menuBar .="			<li><a href='index.php?contentId=suche_eltern'>nach Eltern</a></li>";
			$menuBar .="			<li><a href='index.php?contentId=suche_information'>nach Informationen</a></li>";
                        $menuBar .="			<li><a href='index.php?contentId=suche_termin'>nach Terminen</a></li>";
			$menuBar .="		</ul>";
			$menuBar .="	</li>";
			$menuBar .="	<li>Postfach";
			$menuBar .="		<ul>";
                        $menuBar .="			<li><a href='index.php?contentId='>neue Nachrichten</a></li>";
                        $menuBar .="			<li><a href='index.php?contentId='>Posteingang</a></li>";
			$menuBar .="			<li><a href='index.php?contentId='>gesendete Nachrichten</a></li>";
			$menuBar .="		</ul>";
			$menuBar .="	</li>";
            $menuBar .="</ul>";   
           
            $menuBar .="</div>";
            
            return $menuBar;
        }
    }
?>