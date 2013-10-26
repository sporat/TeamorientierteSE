<?php
require_once("User.class.php");

class UserLogin {

	// Bezeichner für die Absenden-Schaltfäche
	private $submitKey = "login"; 
	private $pass;
	private $login;
	private $statusText;

	public function doActions() {

		if (array_key_exists($this->submitKey, $_POST)) {
			
			$pass = $_POST["passwort"];
			$login = $_POST["benutzer"];
			
			if(User::getInstance()->login($login, $pass)) {
				
			}else $this->statusText = "Passwort oder Benutzername falsch";
			User::getInstance()->load($login, $pass);
		} 
	}
	public function getStatusText() {
		return $this->statusText;
	}		
	public function __toString() {
		$form = new Template("Login.tmpl.html");
		return $form->__toString();
				
	}
}