<?php
class DBStatement {

	private $dbConn;
	private $result;
	private $affectedRowsCount;
	private $lastError; 
	private $lastNotice; 
	
	public function __construct(DBConnection $conn) {
		$this->dbConn = $conn;
	}
	
	public function __destruct() {
		if (is_resource($this->result)) {mysql_free_result($this->result);}
	}
	
	public function executeQuery($queryStr) {
		$this->result = mysql_query($queryStr, $this->dbConn->getConnection());
		if (is_resource($this->result)) {
			$this->affectedRowsCount = mysql_affected_rows($this->result);
			//$this->lastNotice = mysql_last_notice($this->dbConn->getConnection());
			return true;
		} else {
			//mit der php eigenen Funktion "mysql_last_error($dbConn)"
			$this->lastError = mysql_error($this->dbConn->getConnection());
			return false;
		}	
	}
	
	public function getAffectedRowsCount() {
		return $this->affectedRowsCount; 
	}

	public function getNextRow() {
		if (is_resource($this->result)) {
			return mysql_fetch_array($this->result);
		}
	}
	
	public function getLastError() {
		return $this->lastError;
	}

	public function getLastNotice() {
		return $this->lastNotice;
	}
	
}
?>