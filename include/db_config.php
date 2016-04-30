<?php
class Database{

	private $host = "localhost";
	private $db_name = "test";
	private $username = "pma";
	private $password = "pmapass";
	public $conn;

	

	public function dbConnection() {
		$this->conn = null;
		try{
			$this->conn = new PDO("mysql:host=" .$this->host .";dbname=" .$this->db_name . ";charset=utf8", $this->username, $this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $ex) {
			echo "Connection error : " .$ex->getMessage();
			$this->conn = null;
		}
		return $this->conn;
	}


}
?>