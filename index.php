<?php
    session_start();
    //session_unset();
    //var_dump(get_defined_vars());
    require_once("DBConnection.class.php");
    require_once("DBStatement.class.php");
    require_once("Menu.class.php");
    require_once("MenuBar.class.php");
    require_once("Template.class.php");
    require_once("UserLogin.class.php");
    require_once("User.class.php");
    require_once("Verwaltung.class.php");
    require_once("VerwaltungUeberblick.class.php");
    require_once("LehrerUeberblickLoeschen.class.php");
    require_once("VerwaltungAendern.class.php");
    require_once("LehrerAnlegen.class.php");
    require_once("LehrerUeberblick.class.php");
    require_once("LehrerAendern.class.php");
    require_once("SchuelerAnlegen.class.php");
    require_once("PasswortAendern.class.php");
    require_once("PasswortAendernUeberblick.class.php");
    require_once("ElternUeberblick.class.php");
   
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
    $verwaltungUeberblick = new VerwaltungUeberblick();
    $lehrerUeberblickLoeschen = new LehrerUeberblickLoeschen();
    $verwaltungAendern = new VerwaltungAendern();
    $lehrerAnlegen = new LehrerAnlegen();
    $lehrerUeberblick = new LehrerUeberblick();
    $lehrerAendern = new LehrerAendern();
    $schuelerAnlegen = new SchuelerAnlegen();
    $passwortAendern = new PasswortAendern();
    $passwortAendernUeberblick = new PasswortAendernUeberblick();
    $elternUeberblick = new ElternUeberblick();
            
    // Verarbeitung der Benutzereingaben - Formulare überprüfen
    $userLogin->doActions();
    $userLogout->doActions();
    $verwaltung->doActions();
    $verwaltungAendern->doActions();
    $lehrerUeberblickLoeschen->doActions();
    $lehrerAnlegen->doActions();
    $lehrerAendern->doActions();
    $passwortAendern->doActions();
    $schuelerAnlegen->doActions();
            
    // Sammeln der Statusmeldungen
    $statusTxt = "";
    $statusTxt .= $userLogin->getStatusText();
    $statusTxt .= $verwaltung->getStatusText();

    // Erzeugen des Menüs:
    $head ="EuLe";
    $menu = new Menu();
    $menuBar = new MenuBar();
    $menuBar = $menuBar->__toString();
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
                $mainContent .= $verwaltung->__toString();
            }
            break;
        case ('admin_aendern_liste'):
            if (!isset($_POST['admin_aendern_liste'])) {
                $mainContent .= $verwaltungUeberblick->__toString();
            }
            break;
        case ('admin_aendern'):
            if (!isset($_POST['admin_aendern'])) {
                $mainContent .= $verwaltungAendern->__toString();
            }
            break;
        case ('lehrer_anlegen'):
            if (!isset($_POST['lehrer_anlegen'])) {
                $mainContent .= $lehrerAnlegen->__toString();
            }
            break;
        case ('lehrer_aendern_liste'):
            if (!isset($_POST['lehrer_aendern_liste'])) {
                $mainContent .= $lehrerUeberblick->__toString();
            }
            break;
        case ('lehrer_aendern'):
            if (!isset($_POST['lehrer_aendern'])) {
                $mainContent .= $lehrerAendern->__toString();
            }
            break;
        case ('lehrer_loeschen'):
            if (!isset($_POST['lehrer_loeschen'])) {
                $mainContent .= $lehrerUeberblickLoeschen->__toString();
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
         case ('schueler_anlegen_eltern_liste'):
            if (!isset($_POST['schueler_anlegen_eltern_liste'])) {
                $elternUeberblick->setContentID('schueler_anlegen_kinder_liste');
                $mainContent .= $elternUeberblick->__toString();   
            }
            break;
         case ('schueler_aendern'):
            if (!isset($_POST['schueler_anlegen'])) {
               
            }
            break;
         case ('passwort_verwalten_liste'):
            if (!isset($_POST['passwort_verwalten_liste'])) {
                $mainContent .= $passwortAendernUeberblick->__toString();
            }
            break;
         case ('passwort_verwalten'):
            if (!isset($_POST['passwort_verwalten'])) {
                $mainContent .= $passwortAendern->__toString();
            }
            break;
        case ('faecher_anlegen'):
            if (!isset($_POST['faecher_anlegen'])) {
        
            }
            break;
         case ('schueler_anlegen_kinder_liste'):
            if (!isset($_POST['schueler_anlegen_kinder_liste'])) {
                $elternID = $_REQUEST["id"];
                $schuelerAnlegen->setElternID($elternID);
                $mainContent .= $schuelerAnlegen->__toString();
            }
            break;
    }


    $mainDoc = new Template("index.tmpl.html");
    $mainDoc->setValue("[head]", $head);
    $mainDoc->setValue("[main]", $mainContent);
    $mainDoc->setValue("[top]", $menuBar);
    $mainDoc->setValue("[left]", $leftContent);
    

    echo $mainDoc;

    $_SESSION["userObj"]=serialize (User::getInstance());

?>

