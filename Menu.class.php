<?php
    require_once("Logout.class.php");

    class  Menu {

        public function __toString() {

            $userLogout= new UserLogout();

            $menu = "<div id='menue'><ul>";
            if (User::getInstance()->getRole() == "Systemadministrator") {			
                $menu .= "		<li><div>Systmadministrator</div><ul>";
                $menu .= "			<ul>";
                $menu .= "				<li>Generelle Verwaltung";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=admin_anlegen'>Admin anlegen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=admin_aendern_liste'>Admin ändern</a></li>";
                $menu .= "					<li><a href='index.php?contentId=admin_loeschen'>Admin löschen</a></li>";
                $menu .= "				</ul>";
                $menu .= "				<li>Lehrer verwalten";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=lehrer_anlegen'>Lehrer anlegen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=lehrer_aendern'>Lehrer ändern</a></li>";
                $menu .= "					<li><a href='index.php?contentId=lehrer_loeschen'>Lehrer löschen</a></li>";
                $menu .= "				</ul>";
                $menu .= "                              <li>Eltern verwalten";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=eltern_aendern'>Eltern ändern</a></li>";
                $menu .= "					<li><a href='index.php?contentId=eltern_loeschen'>Eltern löschen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=eltern_aktivieren_systemadmin'>Eltern aktivieren</a></li>";
                $menu .= "					<li><a href='index.php?contentId=eltern_deaktivieren_systemadmin'>Eltern deaktivieren</a></li>";
                $menu .= "				</ul>";
                $menu .= "                              <li><a href='index.php?contentId=passwort_verwalten'>Passwortverwaltung</a></li>";
                $menu .= "                              <li><a href='index.php?contentId=aktivitätsprotokoll_ansehen'>Aktivitätsprotokoll ansehen</a></li>";
                $menu .= "			</ul>";
                $menu .= "		</li>";

            } else if (User::getInstance()->getRole() == "Admin") {
                $menu .= "		<li><div>Verwaltung</div><ul>";
                $menu .= "			<ul>";
                $menu .= "                              <li>Eltern verwalten";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=eltern_aktivieren'>Eltern aktivieren</a></li>";
                $menu .= "					<li><a href='index.php?contentId=eltern_deaktivieren'>Eltern deaktivieren</a></li>";
                $menu .= "				</ul>";
                $menu .= "				<li>Lehrer verwalten";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=lehrer_anlegen'>Lehrer anlegen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=lehrer_aendern'>Lehrer ändern</a></li>";
                $menu .= "					<li><a href='index.php?contentId=lehrer_loeschen'>Lehrer löschen</a></li>";
                $menu .= "                                      <li>Klassenlehrer verwalten";
                $menu .= "                                      <ul>";
                $menu .= "                                          <li><a href='index.php?contentId=lehrer_zu_klassenlehrer'>Lehrer als Klassenlehrer markieren</a></li>";
                $menu .= "                                          <li><a href='index.php?contentId=klassenlehrermarkierung_löschen'>Klassenlehrermarkierung löschen </a></li>";
                $menu .= "                                      </ul>";
                $menu .= "				</ul>";
                $menu .= "                              <ul>";               
                $menu .= "                                  <li><a href='index.php?contentId=klasse_loeschen'>Klasse löschen</a></li>";
                $menu .= "                                  <li><a href='index.php?contentId=note_loeschen'>Noten löschen</a></li>";
                $menu .= "                              </ul>";               
                $menu .= "                              <li>Schüler verwalten";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=schueler_anlegen'>Schüler anlegen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=schueler_aendern'>Schüler ändern</a></li>";
                $menu .= "					<li><a href='index.php?contentId=schueler_loeschen'>Schüler löschen</a></li>";
                $menu .= "				</ul>";   
                $menu .= "                              <li>Fächer verwalten";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=faecher_anlegen'>Fächer anlegen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=faecher_aendern'>Fächer ändern</a></li>";
                $menu .= "				</ul>";    
                $menu .= "                              <li>Informationen verwalten";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=information_anlegen'>Informationen einstellen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=information_aendern'>Informationen ändern</a></li>";
                $menu .= "					<li><a href='index.php?contentId=information_loeschen'>Informationen löschen</a></li>";
                $menu .= "				</ul>"; 
                $menu .= "                              <li>Dokumente verwalten";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=dokumente_anlegen'>Dokumente hochladen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=dokumente_aendern'>Dokumente herunterladen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=dokumente_loeschen'>Dokumente löschen</a></li>";
                $menu .= "				</ul>"; 
                $menu .= "                              <ul>";               
                $menu .= "                                  <li><a href='index.php?contentId=krankmeldung_einsehen'>Krankmeldungen einsehen</a></li>";
                $menu .= "                              </ul>";                        
                $menu .= "			</ul>";
                $menu .= "		</li>";

            } else if (User::getInstance()->getRole() == "Eltern") {
                $menu .= "		<li><div>Lehrer</div><ul>";
                $menu .= "			<ul>";
                $menu .= "                              <li>Noten verwalten";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=noten_einstellen'>Noten einstellen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=noten_aendern'>Noten ändern</a></li>";
                $menu .= "					<li><a href='index.php?contentId=noten_loeschen'>Noten löschen</a></li>";                
                $menu .= "				</ul>";
                $menu .= "                              <li>Fächer- und Klassenzuordnungen verwalten";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=zuordnung_fach_erstellen'>Zuordnung zu einem Fach erstellen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=zuordnung_fach_loeschen'>Zuordnung zu einem Fach löschen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=zuordnung_klasse_erstellen'>Zuordnung zu einer Klasse erstellen</a></li>";                
                $menu .= "					<li><a href='index.php?contentId=zuordnung_klasse_loeschen'>Zuordnung zu einer Klasse löschen</a></li>";                
                $menu .= "				</ul>";
                $menu .= "                              <li><a href='index.php?contentId=schuelerliste_anzeigen'>Schülerliste anzeigen</a></li>";
                $menu .= "                              <li>Termine verwalten";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=termin_anlegen'>Termin anlegen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=termin_aendern'>Termin ändern</a></li>";
                $menu .= "					<li><a href='index.php?contentId=termin_löschen'>Termin löschen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=termin_einsehen'>Termin einsehen</a></li>";
                $menu .= "				</ul>";   
                $menu .= "                              <li>Informationen verwalten";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=information_einstellen'>Information einstellen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=information_aendern'>Information ändern</a></li>";
                $menu .= "					<li><a href='index.php?contentId=information_loeschen'>Information löschen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=information_loeschen'>Information ansehen</a></li>";
                $menu .= "				</ul>";  
                $menu .= "                              <li>Dokumente verwalten";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=dokumente_hochladen'>Dokument hochladen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=dokumente_herunterladen'>Dokument herunterladen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=dokumente_loeschen'>Dokument löschen</a></li>";
                $menu .= "				</ul>";                
                $menu .= "			</ul>";
            }  
            else if (User::getInstance()->getRole() == "Lehrer") {
                $menu .= "		<li><div>Eltern</div><ul>";
                $menu .= "			<ul>";
                $menu .= "                              <li>Allgemeine Einstellungen";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=kinder_zuordnen'>Kinderzuordnung vornehmen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=noten_aendern'>Noten ändern</a></li>";
                $menu .= "					<li><a href='index.php?contentId=noten_loeschen'>Noten löschen</a></li>";                
                $menu .= "				</ul>";
                $menu .= "                              <li>Fächer- und Klassenzuordnungen verwalten";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=zuordnung_fach_erstellen'>Zuordnung zu einem Fach erstellen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=zuordnung_fach_loeschen'>Zuordnung zu einem Fach löschen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=zuordnung_klasse_erstellen'>Zuordnung zu einer Klasse erstellen</a></li>";                
                $menu .= "					<li><a href='index.php?contentId=zuordnung_klasse_loeschen'>Zuordnung zu einer Klasse löschen</a></li>";                
                $menu .= "				</ul>";
                $menu .= "                              <li><a href='index.php?contentId=schuelerliste_anzeigen'>Schülerliste anzeigen</a></li>";
                $menu .= "                              <li>Termine verwalten";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=termin_anlegen'>Termin anlegen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=termin_aendern'>Termin ändern</a></li>";
                $menu .= "					<li><a href='index.php?contentId=termin_löschen'>Termin löschen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=termin_einsehen'>Termin einsehen</a></li>";
                $menu .= "				</ul>";   
                $menu .= "                              <li>Informationen verwalten";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=information_einstellen'>Information einstellen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=information_aendern'>Information ändern</a></li>";
                $menu .= "					<li><a href='index.php?contentId=information_loeschen'>Information löschen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=information_loeschen'>Information ansehen</a></li>";
                $menu .= "				</ul>";  
                $menu .= "                              <li>Dokumente verwalten";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=dokumente_hochladen'>Dokument hochladen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=dokumente_herunterladen'>Dokument herunterladen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=dokumente_loeschen'>Dokument löschen</a></li>";
                $menu .= "				</ul>";                
                $menu .= "			</ul>";                
                
            }  
            else if (User::getInstance()->getRole() == "Klassenlehrer") {
                $menu .= "		<li><div>Lehrer</div><ul>";
                $menu .= "			<ul>";
                $menu .= "                              <li>Noten verwalten";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=noten_einstellen'>Noten einstellen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=noten_aendern'>Noten ändern</a></li>";
                $menu .= "					<li><a href='index.php?contentId=noten_loeschen'>Noten löschen</a></li>";                
                $menu .= "				</ul>";
                $menu .= "                              <li>Fächer- und Klassenverwaltung";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=klasse_erstellen'>Klasse anlegen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=klasse_aendern'>Klasse ändern</a></li>";
                $menu .= "					<li><a href='index.php?contentId=schueler_zu_klasse_erstellen'>Schüler-Klasse-Zuordnung erstellen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=schueler_zu_klasse_löschen'>Schüler-Klasse-Zuordnung löschen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=zuordnung_fach_erstellen'>Zuordnung zu einem Fach erstellen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=zuordnung_fach_loeschen'>Zuordnung zu einem Fach löschen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=zuordnung_klasse_erstellen'>Zuordnung zu einer Klasse erstellen</a></li>";                
                $menu .= "					<li><a href='index.php?contentId=zuordnung_klasse_loeschen'>Zuordnung zu einer Klasse löschen</a></li>";                
                $menu .= "				</ul>";
                $menu .= "                              <li><a href='index.php?contentId=schuelerliste_anzeigen'>Schülerliste anzeigen</a></li>";
                $menu .= "                              <li>Termine verwalten";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=termin_anlegen'>Termin anlegen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=termin_aendern'>Termin ändern</a></li>";
                $menu .= "					<li><a href='index.php?contentId=termin_löschen'>Termin löschen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=termin_einsehen'>Termin einsehen</a></li>";
                $menu .= "				</ul>";   
                $menu .= "                              <li>Informationen verwalten";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=information_einstellen'>Information einstellen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=information_aendern'>Information ändern</a></li>";
                $menu .= "					<li><a href='index.php?contentId=information_loeschen'>Information löschen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=information_loeschen'>Information ansehen</a></li>";
                $menu .= "				</ul>";  
                $menu .= "                              <li>Dokumente verwalten";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=dokumente_hochladen'>Dokument hochladen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=dokumente_herunterladen'>Dokument herunterladen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=dokumente_loeschen'>Dokument löschen</a></li>";
                $menu .= "				</ul>";                
                $menu .= "			</ul>";
            }  
            
            if (User::getInstance()->isLoggedIn()) {
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