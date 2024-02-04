<?php

//To create and close connection
class Connect{
	public $conn;
	
	function __construct(){
		$this->conn = new mysqli("localhost","root","","project");
	}
	
	function __destruct(){
		$ans = $this->conn->close();
	}
}
?>
