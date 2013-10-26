<?php
    require_once("Logout.class.php");

    class Menu {

        public function __toString() {

            $userLogout= new UserLogout();

            $menu = "<div id='menue'><ul>";
            if (User::getInstance()->getRole() == "Administrator") {			
                $menu .= "		<li><div>Administrator</div><ul>";
                $menu .= "			<ul>";
                $menu .= "				<li>Benutzer verwalten";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=user_anlegen'>Benutzer anlegen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=user_aendern'>Benutzer �ndern</a></li>";
                $menu .= "					<li><a href='index.php?contentId=user_loeschen'>Benutzer l�schen</a></li>";
                $menu .= "				</ul>";
                $menu .= "				<li>Arbeitspl�tze verwalten";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=work_anlegen'>Arbeitsplatz anlegen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=work_aendern'>Arbeitsplatz �ndern</a></li>";
                $menu .= "					<li><a href='index.php?contentId=work_loeschen'>Arbeitsplatz l�schen</a></li>";
                $menu .= "				</ul>";
                $menu .= "			</ul>";
                $menu .= "		</li>";

            } else if (User::getInstance()->getRole() == "Arbeitsvorbereiter") {
                $menu .= "		<li><div>Arbeitsvorbereiter</div><ul>";
                $menu .= "			<ul>";
                $menu .= "				<li><a href='index.php?contentId=auftrag_anlegen'>Auftrag anlegen</a></li>";
                $menu .= "				<li><a href='index.php?contentId=arbst_einsehen'>Arbeitsplatzauslastungsstatistik anzeigen</a></li>";
                $menu .= "				<li><a href='index.php?contentId=auftrst_einsehen'>Auftragsdurchlaufstatistik anzeigen</a></li>";
                $menu .= "			</ul>";
                $menu .= "		</li>";

            } else if (User::getInstance()->getRole() == "Werker") {
                $menu .= "		<li><div>Werker</div><ul>";
                $menu .= "			<ul>";
                $menu .= "				<li><a href='index.php?contentId=auftragsbestand'>Auftragsbestand und Auftragszeiten einsehen</a></li>";
                $menu .= "			</ul>";
                $menu .= "		</li>";
            }  if (User::getInstance()->isLoggedIn()) {
                    if(!isset($_POST['abmelden'])) {
                        print($userLogout->__toString());
                    }
            }  if (!(User::getInstance()->isLoggedIn())){
                     $menu .= "		<li><a href='index.php?contentId=login'>Anmelden</a></li>";
                    }
            $menu .= "	</ul></div>";


            return $menu;
        }
    }
?>