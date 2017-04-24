<?php
require_once(LIB_PATH.DS."initialize.php");



// Database Constants
defined('DB_SERVER') ? null : define("DB_SERVER", "localhost");
defined('DB_USER') ? null :define("DB_USER", "root");
defined('DB_PASS') ? null :define("DB_PASS", "GemachSimcha");
defined('DB_NAME') ? null :define("DB_NAME", "gimach");

class MySQLDatabase {

	private $connection;

	function __construct() {
		$this->open_connection();
		}

	public function open_connection() {
	$this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		if (mysqli_connect_errno()) {
	die("Database connection failed: " .
		mysqli_connect_error() .
		" (" . mysqli_connect_errno() . ")"
	);
}	
	}

	public function close_connection() {
		if (isset($this->connection)) {
	mysql_close($this->connection);
	unset($this->connection);
	}
}}

$database = new MySQLDatabase();
 ?>