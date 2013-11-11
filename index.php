<?php
    session_start();
    //session_unset();
    
    require_once("DBConnection.class.php");
    require_once("DBStatement.class.php");
    require_once("Menu.class.php");
    require_once("Template.class.php");
    require_once("UserLogin.class.php");
    require_once("User.class.php");
    require_once("Verwaltung.class.php");
    require_once("UserOutline.class.php");
    require_once("AdminAendern.class.php");
    
   
    //require_once("UserLogout.class.php");
    //
    // Benutzer aus der Session auslesen oder neu erzeugen
    if (array_key_exists("userObj", $_SESSION)) {
        User::setAsInstance(unserialize($_SESSION["userObj"]));
    }

    // Formularklassen anlegen
    $userLogin = new UserLogin();
    $userLogout = new UserLogout();
    $verwaltung = new Verwaltung();
    $userOutline = new UserOutline();
    $adminAendern = new AdminAendern();
    

    // Verarbeitung der Benutzereingaben - Formulare überprüfen
    $userLogin->doActions();
    $userLogout->doActions();
    $verwaltung->doActions();
    $adminAendern->doActions();    

    // Sammeln der Statusmeldungen
    $statusTxt = "";
    $statusTxt .= $userLogin->getStatusText();
    $statusTxt .= $verwaltung->getStatusText();

    // Erzeugen des Menüs:
    $head ="EuLe";
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
        case ('admin_anlegen'):
            if (!isset($_POST['admin_anlegen'])) {
                $mainContent .= $verwaltung->__toStringAdminAnlegen();
            }
            break;
        case ('admin_aendern_liste'):
            if (!isset($_POST['admin_aendern_liste'])) {
                $mainContent .= $userOutline->__toString();
            }
            break;
        case ('admin_aendern'):
            if (!isset($_POST['admin_aendern'])) {
                $mainContent .= $adminAendern->__toString();
            }
            break;
        case ('admin_loeschen'):
            if (!isset($_POST['admin_loeschen'])) {
                
            }
            break;
        case ('lehrer_anlegen'):
            if (!isset($_POST['lehrer_anlegen'])) {
                
            }
            break;
        case ('lehrer_aendern'):
            if (!isset($_POST['lehrer_aendern'])) {
                
            }
            break;
        case ('lehrer_loeschen'):
            if (!isset($_POST['lehrer_loeschen'])) {
                
            }
            break;
        case ('eltern_aendern'):
            if (!isset($_POST['eltern_aendern'])) {
                
            }
            break;
        case ('eltern_loeschen'):
            if (!isset($_POST['eltern_loeschen'])) {
                
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

