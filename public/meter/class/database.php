<?php
class Database {
 var $mysqli;
 
 function __construct() {
		$this->mysqli = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
		
		if ($this->mysqli->connect_errno) {
			die("Connect failed: " . $this->mysqli->connect_error);
			return;
		}
		
		if (!$this->mysqli->set_charset("utf8")) {
   die("Error loading character set utf8: " . $this->mysqli->error);
			return;
		}
		mysqli_set_charset($this->mysqli, "utf8");
	}
}
?>