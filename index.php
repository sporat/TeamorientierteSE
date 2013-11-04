<?php
    session_start();
    session_unset();
    
    require_once("DBConnection.class.php");
    require_once("DBStatement.class.php");
    require_once("Menu.class.php");
    require_once("UserLogin.class.php");
    require_once("User.class.php");
    require_once("Template.class.php");
   
    //require_once("UserLogout.class.php");
    //
    // Benutzer aus der Session auslesen oder neu erzeugen
    if (array_key_exists("userObj", $_SESSION)) {
        User::setAsInstance(unserialize($_SESSION["userObj"]));
    }

    // Formularklassen anlegen
    $userLogin = new UserLogin();
    $userLogout= new UserLogout();

    // Verarbeitung der Benutzereingaben - Formulare überprüfen
    $userLogin->doActions();
    $userLogout->doActions();	

    // Sammeln der Statusmeldungen
    $statusTxt = "";
    $statusTxt .= $userLogin->getStatusText();

    // Erzeugen des Menüs:
    $head ="test";
    $menu = new Menu();
    $leftContent = $menu->__toString();

    if ($statusTxt) {
        $statusTxt =  "<div id='status'>{$statusTxt}</div>";
    }

    $mainContent = $statusTxt;

    // Erzeugenen des eigentlichen Inhalts (Fallunterscheidung bzgl. contentId!)
    if (array_key_exists("contentId", $_REQUEST)) {
        $contentId = $_REQUEST["contentId"];
    } else {
        $contentId = "";
    }
    switch ($contentId) {
        case ('login'):
            if (!isset($_POST['login'])) {
                $mainContent .= $userLogin->__toString();
            }
        break; 		
    }


    $mainDoc = new Template("index.tmpl.html");
    $mainDoc->setValue("[head]", $head);
    $mainDoc->setValue("[left]", $leftContent);
    $mainDoc->setValue("[main]", $mainContent);

    echo $mainDoc;

    $_SESSION["userObj"]=serialize (User::getInstance());

?>

