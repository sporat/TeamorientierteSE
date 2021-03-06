<?php
    require_once("Logout.class.php");

    class  Menu {

        public function __toString() {

            $userLogout= new UserLogout();
            $menu = "<div id='menue'><ul>";
               if(User::getInstance()->isLoggedIn()){
            
           if (User::getInstance()->getRole() == "Systemadministrator") {			
                $menu .= "		<li>Verwaltung";
                $menu .= "			<ul>";
                $menu .= "					<li><a href='index.php?contentId=admin_anlegen'>Verwaltung anlegen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=admin_aendern_liste'>Verwaltung &auml;ndern</a></li>";
                $menu .= "			</ul>";
                $menu .= "		</li>";
                $menu .= "		<li>Lehrer verwalten";
                $menu .= "			<ul>";
                $menu .= "					<li><a href='index.php?contentId=lehrer_anlegen'>Lehrer anlegen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=lehrer_aendern_liste'>Lehrer &auml;ndern</a></li>";
                $menu .= "					<li><a href='index.php?contentId=lehrer_loeschen'>Lehrer l&ouml;schen</a></li>";
                $menu .= "			</ul>";
                $menu .= "		</li>";
                $menu .= "      <li>Eltern verwalten";
                $menu .= "			<ul>";
                $menu .= "					<li><a href='index.php?contentId=eltern_aendern_liste'>Eltern &auml;ndern</a></li>";
                $menu .= "					<li><a href='index.php?contentId=eltern_loeschen_liste'>Eltern l&ouml;schen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=eltern_aktivieren'>Eltern aktivieren</a></li>";
                $menu .= "					<li><a href='index.php?contentId=eltern_deaktivieren'>Eltern deaktivieren</a></li>";
                $menu .= "			</ul>";
                $menu .= "		</li>";
				$menu .= "      <li>Sonstiges";
                $menu .= "			<ul>";
                $menu .= "                  <li><a href='index.php?contentId=passwort_verwalten_liste'>Passwortverwaltung</a></li>";
                $menu .= "                  <li><a href='index.php?contentId=aktivit&auml;tsprotokoll_ansehen'>Aktivit&auml;tsprotokoll ansehen</a></li>";
                $menu .= "			</ul>";
                $menu .= "		</li>";
  
			} else if (User::getInstance()->getRole() == "Verwaltung") {
                $menu .= "      <li>Eltern verwalten";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=eltern_aktivieren'>Eltern aktivieren</a></li>";
                $menu .= "					<li><a href='index.php?contentId=eltern_deaktivieren'>Eltern deaktivieren</a></li>";
                $menu .= "				</ul>";
                $menu .= "		</li>";
                $menu .= "		<li>Lehrer verwalten";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=lehrer_anlegen'>Lehrer anlegen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=lehrer_aendern_liste'>Lehrer &auml;ndern</a></li>";
                $menu .= "					<li><a href='index.php?contentId=lehrer_loeschen'>Lehrer l&ouml;schen</a></li>";
                $menu .= "				</ul>";
				$menu .= "				</li>";
                $menu .= "      <li>Klassenlehrer verwalten";
                $menu .= "              <ul>";
                $menu .= "             		<li><a href='index.php?contentId=lehrer_zu_klassenlehrer'>Lehrer als Klassenlehrer markieren</a></li>";
                $menu .= "         			<li><a href='index.php?contentId=klassenlehrermarkierung_loeschen'>Klassenlehrer- markierung l&ouml;schen </a></li>";
                $menu .= "              </ul>";
                $menu .= "		</li>";
                $menu .= "   	<li>Termine verwalten";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=termin_anlegen'>Termin anlegen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=termin_aendern'>Termin &auml;ndern</a></li>";
                $menu .= "					<li><a href='index.php?contentId=termin_loeschen'>Termin l&ouml;schen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=termin_einsehen'>Termin einsehen</a></li>";
                $menu .= "				</ul>";
				$menu .= "		</li>";
                $menu .= "   	<li>Klassen/ Noten l&ouml;schen";
                $menu .= "              <ul>";               
                $menu .= "      		    <li><a href='index.php?contentId=klasse_loeschen'>Klasse l&ouml;schen</a></li>";
                $menu .= "                  <li><a href='index.php?contentId=note_loeschen'>Noten l&ouml;schen</a></li>";
                $menu .= "              </ul>";    
				$menu .= "		</li>";
                $menu .= "      <li>Sch&uuml;ler verwalten";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=schueler_anlegen'>Sch&uuml;ler anlegen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=schueler_aendern'>Sch&uuml;ler &auml;ndern</a></li>";
                $menu .= "					<li><a href='index.php?contentId=schueler_loeschen'>Sch&uuml;ler l&ouml;schen</a></li>";
                $menu .= "				</ul>";
				$menu .= "		</li>";
                $menu .= "      <li>F&auml;cher verwalten";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=faecher_anlegen'>F&auml;cher anlegen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=faecher_aendern_liste'>F&auml;cher &auml;ndern</a></li>";
                $menu .= "				</ul>";
				$menu .= "		</li>";				
                $menu .= "      <li>Informationen verwalten";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=information_anlegen'>Informationen einstellen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=information_aendern'>Informationen &auml;ndern</a></li>";
                $menu .= "					<li><a href='index.php?contentId=information_loeschen'>Informationen l&ouml;schen</a></li>";
                $menu .= "				</ul>";
				$menu .= "		</li>";
                $menu .= "      <li>Dokumente verwalten";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=dokumente_hochladen'>Dokumente hochladen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=dokumente_herunterladen'>Dokumente herunterladen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=dokumente_loeschen'>Dokumente l&ouml;schen</a></li>";
                $menu .= "				</ul>";
				$menu .= "		</li>";
				$menu .= "      <li>Krankmeldungen";
                $menu .= "              <ul>";               
                $menu .= "                   <li><a href='index.php?contentId=krankmeldung_einsehen'>Krankmeldungen einsehen</a></li>";
                $menu .= "              </ul>";                        
                $menu .= "		</li>";

            } else if (User::getInstance()->getRole() == "Lehrer") {
                $menu .= "      <li>Noten verwalten";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=noten_einstellen'>Noten einstellen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=noten_aendern'>Noten &auml;ndern</a></li>";
                $menu .= "					<li><a href='index.php?contentId=noten_loeschen'>Noten l&ouml;schen</a></li>";                
                $menu .= "				</ul>";
				$menu .= "      </li>";
                $menu .= "      <li>F&auml;cher- und Klassenzuordnungen verwalten";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=zuordnung_fach_erstellen'>Zuordnung zu einem Fach erstellen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=zuordnung_fach_loeschen'>Zuordnung zu einem Fach l&ouml;schen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=zuordnung_klasse_erstellen'>Zuordnung zu einer Klasse erstellen</a></li>";                
                $menu .= "					<li><a href='index.php?contentId=zuordnung_klasse_loeschen'>Zuordnung zu einer Klasse l&ouml;schen</a></li>";                
                $menu .= "				</ul>";
				$menu .= "      </li>";
				$menu .= "      <li>Sch&uuml;liste";
				$menu .= "      		<ul>";
                $menu .= "                  <li><a href='index.php?contentId=schuelerliste_anzeigen'>Sch&uuml;lerliste anzeigen</a></li>";
                $menu .= "				</ul>";
				$menu .= "      </li>";
				$menu .= "      <li>Termine verwalten";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=termin_anlegen'>Termin anlegen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=termin_aendern'>Termin &auml;ndern</a></li>";
                $menu .= "					<li><a href='index.php?contentId=termin_l&ouml;schen'>Termin l&ouml;schen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=termin_einsehen'>Termin einsehen</a></li>";
                $menu .= "				</ul>"; 
				$menu .= "      </li>";
                $menu .= "      <li>Informationen verwalten";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=information_anlegen'>Information einstellen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=information_aendern'>Information &auml;ndern</a></li>";
                $menu .= "					<li><a href='index.php?contentId=information_loeschen'>Information l&ouml;schen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=information_aendern'>Information ansehen</a></li>";
                $menu .= "				</ul>";
				$menu .= "      </li>";
                $menu .= "      <li>Dokumente verwalten";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=dokumente_hochladen'>Dokument hochladen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=dokumente_herunterladen'>Dokument herunterladen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=dokumente_loeschen'>Dokument l&ouml;schen</a></li>";
                $menu .= "				</ul>";                
                $menu .= "		</li>";
            }  
            //Eltern Menü anpassen!!!!
            else if (User::getInstance()->getRole() == "Eltern") {
                $menu .= "      <li>Allgemeine Einstellungen";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=wkinder_zuordnen'>Kinderzuordnung vornehmen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=lehrer_liste_einsehen'>Lehrer&uuml;bersicht</a></li>";
                $menu .= "					<li><a href='index.php?contentId=kinder_krankmelden'>Kind krankmelden</a></li>";
				$menu .= "				</ul>";
				$menu .= "		</li>";
                $menu .= "      <li>Mitteilungen";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=mitteilungsweg_aendern'>Mitteilungsweg &auml;ndern</a></li>";
                $menu .= "					<li><a href='index.php?contentId=nachricht_schreiben'>Neue Nachricht senden</a></li>";
				$menu .= "				</ul>";
				$menu .= "		</li>";
                $menu .= "      <li>Termine";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=termin_einsehen'>Termin einsehen</a></li>";
                $menu .= "				</ul>";
				$menu .= "		</li>";
                $menu .= "      <li>Informationen ";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=information_ansehen'>Information ansehen</a></li>";
                $menu .= "				</ul>";
				$menu .= "		</li>";
                $menu .= "      <li>Dokumente";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=dokumente_herunterladen'>Dokument herunterladen</a></li>";
                $menu .= "				</ul>";                
                $menu .= "		</li>";                
                
            }  
            else if (User::getInstance()->getRole() == "Klassenlehrer") {
                $menu .= "      <li>Noten verwalten";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=noten_einstellen'>Noten einstellen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=noten_aendern'>Noten &auml;ndern</a></li>";
                $menu .= "					<li><a href='index.php?contentId=noten_loeschen'>Noten l&ouml;schen</a></li>";                
                $menu .= "				</ul>";
				$menu .= "		</li>";
                $menu .= "      <li>F&auml;cher- und Klassenverwaltung";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=klasse_erstellen'>Klasse anlegen</a></li>";
                $menu .= "                  <li><a href='index.php?contentId=klassen_ohne_leiter_liste'>Zuordnung zu einer Klasse</a></li>";
                $menu .= "					<li><a href='index.php?contentId=klasse_aendern'>Klasse &auml;ndern</a></li>";
                $menu .= "					<li><a href='index.php?contentId=schueler_zu_klasse_erstellen'>Sch&uuml;ler-Klasse-Zuordnung erstellen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=schueler_zu_klasse_loeschen'>Sch&uuml;ler-Klasse-Zuordnung l&ouml;schen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=zuordnung_fach_erstellen'>Zuordnung zu einem Fach erstellen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=zuordnung_fach_loeschen'>Zuordnung zu einem Fach l&ouml;schen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=zuordnung_klasse_erstellen'>Zuordnung zu einer Klasse erstellen</a></li>";                
                $menu .= "					<li><a href='index.php?contentId=zuordnung_klasse_loeschen'>Zuordnung zu einer Klasse l&ouml;schen</a></li>";                
                $menu .= "				</ul>";
				$menu .= "		</li>";
				$menu .= "      <li>Sch&uuml;liste";
				$menu .= "      		<ul>";
                $menu .= "                  <li><a href='index.php?contentId=schuelerliste_anzeigen'>Sch&uuml;lerliste anzeigen</a></li>";
                $menu .= "				</ul>";
				$menu .= "      </li>";				        
                $menu .= "      <li>Termine verwalten";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=termin_anlegen'>Termin anlegen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=termin_aendern'>Termin &auml;ndern</a></li>";
                $menu .= "					<li><a href='index.php?contentId=termin_l&ouml;schen'>Termin l&ouml;schen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=termin_einsehen'>Termin einsehen</a></li>";
                $menu .= "				</ul>"; 
				$menu .= "      </li>";
                $menu .= "      <li>Informationen verwalten";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=information_anlegen'>Information einstellen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=information_aendern'>Information &auml;ndern</a></li>";
                $menu .= "					<li><a href='index.php?contentId=information_loeschen'>Information l&ouml;schen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=information_aendern'>Information ansehen</a></li>";
                $menu .= "				</ul>";
				$menu .= "      </li>";
                $menu .= "      <li>Dokumente verwalten";
                $menu .= "				<ul>";
                $menu .= "					<li><a href='index.php?contentId=dokumente_hochladen'>Dokument hochladen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=dokumente_herunterladen'>Dokument herunterladen</a></li>";
                $menu .= "					<li><a href='index.php?contentId=dokumente_loeschen'>Dokument l&ouml;schen</a></li>";
                $menu .= "				</ul>";
				$menu .= "      </li>";
            }  
            
            
                    if(!isset($_POST['abmelden'])) {
                        $menu.=($userLogout->__toString());
                    }
               }
            elseif (!(User::getInstance()->isLoggedIn())){
                     $menu .= "		<li><a href='index.php?contentId=login'>Anmelden</a></li>";
                     $menu .= "		<li><a href='index.php?contentId=registrieren'>Am System registrieren</a></li>";
                    }
        
            $menu .= "	</ul></div>";
        

            return $menu;
        }
    
    }
?>