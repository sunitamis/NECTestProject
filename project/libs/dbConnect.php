<?php

//To create and close connection
class Connect extends Exception {
	protected $db;
	
	function __construct(){
		$hostname_db = "localhost";
		$username_db = "root";
		$password_db = "";
		$db_name 	 = "project";
		try
		{
			$this->db = mysqli_connect($hostname_db, $username_db, $password_db, $db_name);
			if (mysqli_connect_errno())
			{
				throw new RuntimeException();
			}
		}
		catch (RuntimeException $ex)
		{
			die( "Connection failed: " .mysqli_connect_error(). "\n");
		}
		catch(Exception $e)
		{
			die( $e->getMessage() );
		}
	}
	
	function __destruct(){
		$this->db->close();
	}
}
?>
