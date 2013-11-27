<?php

session_start();
//session_unset();
//var_dump(get_defined_vars());
var_dump($_REQUEST);
header('Content-Type: text/html; charset=utf-8');
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
require_once("ElternAnlegen.class.php");
require_once("KindHinzufuegen.class.php");
require_once("SchuelerAendern.class.php");
require_once("SchuelerUeberblick.class.php");
require_once("ElternAktivieren.class.php");
require_once("ElternDeaktivieren.class.php");
require_once("SchuelerLoeschen.class.php");
require_once("SchuelerUeberblickLoeschen.class.php");
require_once("WeitereKinderHinzufuegen.class.php");
require_once("LehrerLoeschen.class.php");
require_once("ElternAendern.class.php");
require_once("ElternUeberblick.class.php");
require_once("ElternUeberblickLoeschen.class.php");
require_once("ElternLoeschen.class.php");
require_once("Klassenlehrer_or_notUeberblick.class.php");
require_once("FachAnlegen.class.php");
require_once("FachAendern.class.php");
require_once("FachUeberblick.class.php");
require_once("TerminAnlegen.class.php");
require_once("TerminKlasseZuordnung.class.php");
require_once ("InfoAnlegen.class.php");
require_once ("InfoKlasseZuordnung.class.php");
//require_once("UserLogout.class.php");
require_once ("KlassenOhneLeiterUeberblick.class.php");

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
$elternAnlegen = new ElternAnlegen();
$kindHinzufuegen = new KindHinzufuegen();
$schuelerAendern = new SchuelerAendern();
$schuelerUeberblick = new SchuelerUeberblick();
$elternAktivieren = new ElternAktivieren();
$elternDeaktivieren = new ElternDeaktivieren();
$schuelerUeberblickLoeschen = new SchuelerUeberblickLoeschen();
$schuelerLoeschen = new SchuelerLoeschen();
$weitereKinderHinzufuegen = new WeitereKinderHinzufuegen();
$lehrerLoeschen = new LehrerLoeschen();
$elternAendern= new ElternAendern();
$elternUeberblickLoeschen = new ElternUeberblickLoeschen();
$elternLoeschen = new ElternLoeschen();
$klassenlehrerUeberblick = new Klassenlehrer_or_notUeberblick();
$fachAnlegen= new FachAnlegen();
$fachAendern = new FachAendern();
$fachUeberblick = new FachUeberblick();
$terminAnlegen= new TerminAnlegen();
$terminKlasseZuordnung = new TerminKlasseZuordnung();
$infoAnlegen = new InfoAnlegen();
$infoKlasseZuordnung = new InfoKlasseZuordnung();
$klassenOhneLeiterUeberblick = new KlassenOhneLeiterUeberblick();


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
$elternAnlegen->doActions();
$kindHinzufuegen->doActions();
$schuelerAendern->doActions();
$elternAktivieren->doActions();
$elternDeaktivieren->doActions();
$schuelerUeberblickLoeschen->doActions();
$schuelerLoeschen->doActions();
$weitereKinderHinzufuegen->doActions();
$lehrerLoeschen->doActions();
$elternAendern->doActions();
$elternUeberblickLoeschen->doActions();
$elternLoeschen->doActions();
$klassenlehrerUeberblick->doActions();
$fachAnlegen->doActions();
$fachAendern->doActions();
$terminAnlegen->doActions();
$terminKlasseZuordnung->doActions();
$infoAnlegen->doActions();
$infoKlasseZuordnung->doActions();
//$klassenUeberblick->doActions();
//
//
// Sammeln der Statusmeldungen
$statusTxt = "";
$statusTxt .= $userLogin->getStatusText();
$statusTxt .= $verwaltung->getStatusText();
$statusTxt .= $schuelerUeberblickLoeschen->getStatusText();
$statusTxt .= $schuelerLoeschen->getStatusText();
$statusTxt .= $lehrerLoeschen->getStatusText();
$statusTxt .= $elternAendern->getStatusText();
$statusTxt .= $elternUeberblickLoeschen->getStatusText();
$statusTxt .= $elternLoeschen->getStatusText();
$statusTxt .= $fachAnlegen->getStatusText();
$statusTxt .= $fachAendern->getStatusText();
$statusTxt .= $infoAnlegen->getStatusText();
$statusTxt .= $infoKlasseZuordnung->getStatusText();
// Erzeugen des Menüs:
$head = "EuLe";
$menu = new Menu();
$menuBar = new MenuBar();
$menuBar = $menuBar->__toString();
$leftContent = $menu->__toString();


if ($statusTxt) {
    $statusTxt = "<div id='status'>{$statusTxt}</div>";
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
    case ('eltern_aendern_liste'):
        if (!isset($_POST['eltern_aendern_liste'])) {
            $mainContent .= $elternUeberblick->__toString();
        }
        break;
	case ('eltern_aendern'):
        if (!isset($_POST['eltern_aendern'])) {
            $mainContent .= $elternAendern->__toString();
        }
        break;
    case ('eltern_loeschen_liste'):
        if (!isset($_POST['eltern_loeschen_liste'])) {
            $mainContent .= $elternUeberblickLoeschen->__toString();
        }
        break;
	case ('eltern_loeschen'):
        if (!isset($_POST['eltern_loeschen'])) {
            $mainContent .= $elternLoeschen->__toString();
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
            $mainContent .= $fachAnlegen->__toString();
        }
        break;
	case ('faecher_aendern_liste'):
        if (!isset($_POST['faecher_aendern_liste'])) {
            $mainContent .= $fachUeberblick->__toString();
        }
        break;
	case ('fach_aendern_formular'):
		if (!isset($_POST['fach_aendern_formular'])) {
			$mainContent .= $fachAendern->__toString();
		}
		break;
    case ('schueler_anlegen'):
        if (!isset($_POST['schueler_anlegen'])) {
            $mainContent .= $schuelerAnlegen->__toString();
        }
        break;
    case ('registrieren'):
        if (!isset($_POST['registrieren'])) {
            $mainContent .=$elternAnlegen->__toString();
        }
        break;
    case ('kind_hinzufuegen'):
        if (!isset($_POST['kind_hinzufuegen'])) {
            $mainContent .=$kindHinzufuegen->__toString();
        }
        break;
    case('schueler_aendern'):
        if (!isset($_POST['schueler_aendern'])) {
            $mainContent .= $schuelerUeberblick->__toString();
        }
        break;
    case('schueler_aendern_formular'):
        if (!isset($_POST['schueler_aendern_formular'])) {
            $mainContent.= $schuelerAendern->__toString();
        }
        break;
    case('eltern_aktivieren'):
        if (!isset($_POST['eltern_aktivieren'])) {
            $mainContent.=$elternAktivieren->__toString();
        }
        break;
    case('eltern_deaktivieren'):
        if (!isset($_POST['eltern_deaktivieren'])) {
            $mainContent.=$elternDeaktivieren->__toString();
        }
        break;
    case('schueler_loeschen'):
        if (!isset($_POST['schueler_loeschen'])) {
            $mainContent .= $schuelerUeberblickLoeschen->__toString();
        }
        break;
      /*    case('wkinder_zuordnen'):
        if (!isset($_POST['wkinder_zuordnen'])) {
            $mainContent .= $weitereKinderHinzufuegen->__toString();
        }*/
        break;
        case('lehrer_zu_klassenlehrer'):
        if (!isset($_POST['klassenlehrer_aendern'])) {
            $mainContent .= $klassenlehrerUeberblick->__toString();
        }
        break;
         case('klassenlehrermarkierung_loeschen'):
        if (!isset($_POST['klassenlehrer_aendern'])) {
            $mainContent .= $klassenlehrerUeberblick->__toString();
        }
        break;
         case('termin_anlegen'):
        if (!isset($_POST['termin_anlegen'])) {
            $mainContent .= $terminAnlegen->__toString();
        }
        break;
        case('klasse_termin'):
        if (!isset($_POST['Zuordnen'])) {
            $mainContent .= $terminKlasseZuordnung->__toString();
        }
        break;
         case('information_anlegen'):
        if (!isset($_POST['information_anlegen'])) {
            $mainContent .= $infoAnlegen->__toString();
        }
        break;
        case('klasse_info'):
        if (!isset($_POST['Zuordnen'])) {
            $mainContent .= $infoKlasseZuordnung->__toString();
        }
        break;
        case('klassen_ohne_leiter_liste'):
        if (!isset($_POST['klassen_ohne_leiter_liste'])) {
            $mainContent .= $klassenOhneLeiterUeberblick->__toString();
        }
        break;
        case('zu_klasse_zuordnen'):
        if (!isset($_POST['zu_klasse_zuordnen'])) {
            $mainContent .= $klassenOhneLeiterUeberblick->doActions();
        }
        break;
}




$mainDoc = new Template("index.tmpl.html");
$mainDoc->setValue("[head]", $head);
$mainDoc->setValue("[main]", $mainContent);
$mainDoc->setValue("[top]", $menuBar);
$mainDoc->setValue("[left]", $leftContent);


echo $mainDoc;

$_SESSION["userObj"] = serialize(User::getInstance());
?>

