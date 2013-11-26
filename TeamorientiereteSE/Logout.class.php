<?php
require_once("User.class.php");
	class UserLogout {
	
	private $submitKey = "abmelden"; // 

		public function doActions() {
			if (array_key_exists($this->submitKey, $_POST)) {
			User::getInstance()-> logout();	
			} 
		}
	
	
		public function __toString() {
			$form = new Template("Logout.tmpl.html");
			return $form->__toString();
		}
	}
?>