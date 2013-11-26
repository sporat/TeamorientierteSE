<?php
require_once("User.class.php");
require_once("DBStatement.class.php");
require_once("DBConnection.class.php");

class UserListe {

	private $user;
	
	public function __construct() {
		$this->user = array();
		
		$statement = new DBStatement(DBConnection::getInstance());
                $query = "SELECT Benutzername, BenutzerID, Rolle FROM benutzer order by Rolle, Benutzername ASC";
		$statement->executeQuery($query);
		while ($row = $statement->getNextRow()) {
			$user = new User();
			$user->laden($row["Benutzername"]);
			
			// Mit array_push werden neue Werte am Ende des Arrays angefügt 
			array_push($this->user, $user);
		}
	}

	public function getUser() {
		// korrekter Weise müsste hier das Array noch kopiert werden
		return $this->user;
	}
	
}
