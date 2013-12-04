<?php

require_once("Template.class.php");
require_once("ElternSQL.class.php");

class MitteilungswegAendern {

	
	private $statusText;
	private $submitKey = "eltern_mitteilungsweg_aendern";
        private $mitteilungsweg;
	
	
	

	public function doActions() {
            
		// Prüfen ob das Formular dieser Sicht übergeben wurde
		if (array_key_exists($this->submitKey, $_POST)) {
                    print "hier";
			$this->mitteilungsweg = $_REQUEST['weg'];
			
					
			
			
			$elternsql = new ElternSQL();
                       if( $elternsql->mitteilungswegAendern($this->mitteilungsweg))
                       {
                           $this->statusText = "Mitteilungweg erfolgreich geändert!";
                       }
                       else {
                           $this->statusText = "Fehler beim Ändern des Mitteilungswegs!";
                       }
				 
                }
        }
	public function getStatusText() {
		return $this->statusText;
	}

	/**
	 * Gibt die textuelle (HTML) Repräsentation des Objekt zurück
	 */
	public function __toString() {
		// Erstellen des Login-Formulars mit Hilfe des zugehörigen Templates
		$form = new Template("MitteilungswegAendern.tmpl.html");
                $elternsql = new ElternSQL();
		
		if($elternsql->oldMitteilungsweg()== 'Post')
                {
                    $form->setValue('selectedpost', 'selected');
                }
                else{
                    $form->setValue('selectedsystem', 'selected');
                }

		// erstelltes Formular zurück geben
		return $form->__toString();
	}

}