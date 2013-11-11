<?php
require_once("UserInfo.class.php");
require_once("DBStatement.class.php");
require_once("DBConnection.class.php");

class UserList {
	
	private $admin;
	
	public function __construct() {
		$this->admin = array();
		
		$connect = new DBConnection();
		$statement = new DBStatement($connect);
		$statement->executeQuery("SELECT BenutzerID FROM benutzer;");
		while ($row = $statement->getNextRow()) {
			$admin = new UserInfo();
			$admin->laden($row["BenutzerID"]);
			
			// Mit array_push werden neue Werte am Ende des Arrays angefügt 
			array_push($this->admin, $admin);
		}
	}

	public function getAdmin() {
		// korrekter Weise müsste hier das Array noch kopiert werden
		return $this->admin;
	}
	
}