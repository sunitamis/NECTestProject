<?php
require_once('dbConnect.php');
require_once('../libs/validate.php');

class Helper extends Connect
{
	/**
	*@desc Function to insert data in database
	*@param $table - Tablename
	*@param $field - Column name
	*@param $value - Column values
	**/
	public function insert($table = "", $field = "", $value = ""){
		if(!empty($table) && !empty($field) && !empty($value)){
			try {
				$sql = "INSERT INTO $table ($field) VALUES ($value)";
				$result = $this->db->query($sql);

				if (!$result) {
				  throw new Exception("Error description: " . $this->db->error);
				}
				return true;
			}
			catch(Exception $e){
				die($e->getMessage());
			}
		}
		return false;
	}

	/**
	*@desc Function to select data from database
	*@param $table - Tablename
	*@param $field - Column name
	*@param $condition - Condition on which data needs to be selected
	**/
	public function select($field = '', $table = '', $condition = ''){
		if( !empty($field) && !empty($table) && !empty($condition) ){
			try {
				$query = "SELECT $field FROM $table WHERE $condition";
				$result = $this->db->query($query);
				if (!$result) {
				  throw new Exception("Error description: " . $this->db->error);
				}else{
					if($result->num_rows==0){
						return false;
					}
					else{
						while($row = $result->fetch_array(MYSQLI_NUM)){
							$data[] = $row	;	
						}			
						
						return $data;
					}
				}
			}
			catch(Exception $e){
				die($e->getMessage());
			}
		}
		return false;
	}
	
	/**
	*@desc Function to check if valid username passed
	*@param $email - Value to be validated
	**/		
	public function validateUsername($username)
	{
		$error_msg = [];
		$validUsername = Validate::isEmptyCheck ( $username, "Username");
		if( $validUsername !== true ){
			$error_msg[] = $validUsername;
		}else{
			$validUsername = Validate::isAlphaNumeric ( $username, "Username");

			if( $validUsername !== true ){
				$error_msg[] = $validUsername;
			}
		}
		return $error_msg;
	}
	
	/**
	*@desc Function to check if valid password passed
	*@param $email - Value to be validated
	**/		
	public function validatePassword($password, $confirm = 0)
	{
		$error_msg = [];
		$field_name = ($confirm) ? "Confirm Password" : "Password";
		$validPassword = Validate::isEmptyCheck ( $password, $field_name);
		if( $validPassword !== true ){
			$error_msg[] = $validPassword;
		}else{
			$validPassword = Validate::isValidPassword ( $password, $field_name);

			if( $validPassword !== true ){
				$error_msg[] = $validPassword;
			}
		}
		return $error_msg;
	}
	
	/**
	*@desc Function to check if password and confirm password values passed are matching or not
	*@param $pwd - Value to be validated
	*@param $confirm_pwd - Value to be validated
	**/		
	public function checkPasswordMatch( $pwd = "", $confirm_pwd = ""){
		$error_msg = [];
		if(!empty($pwd) && !empty($confirm_pwd) && $pwd != $confirm_pwd){
			$error_msg[] = "Password does not match.";
		}
		return $error_msg;
	}
	
	/**
	*@desc Function to check if valid email id passed
	*@param $email - Value to be validated
	**/		
	public function validateEmail($email_id)
	{
		$error_msg = [];
		$validEmail = Validate::isEmptyCheck ( $email_id, "Email Id");
		if( $validEmail !== true ){
			$error_msg[] = $validEmail;
		}else{
			$validEmail = Validate::isValidEmail ( $email_id, "Email Id");

			if( $validEmail !== true ){
				$error_msg[] = $validEmail;
			}
		}
		return $error_msg;
	}
	
	/**
	*@desc Function to check if valid email id passed
	*@param $email - Value to be validated
	**/		
	public function validateCaptcha($captcha)
	{
		$error_msg = [];
		$validCaptcha = Validate::isEmptyCheck ( $captcha, "Captcha");
		if( $validCaptcha !== true ){
			$error_msg[] = $validCaptcha;
		}else{
			session_start();
			if( isset($_SESSION['captcha_code']) && $_SESSION['captcha_code'] != $captcha ){
				$error_msg[] = "Invalid Captcha. Re-enter Captcha";
			}
		}
		return $error_msg;
	}

	/*
	* @desc Function to execute db query
	* @param $sql - SQL query whichi will get executed
	*/
	public function exe($sql)
	{
		if(!empty($sql)){
			$this->db->query($sql) or die($this->conn->error);
		}
	}
	
	/**
	*@desc Function to format error messages
	*@param $error Error messaged to be formatted for display
	**/
	public function showError( $error = "" ){
		if( !empty($error) ){
			echo '<ul>';
			if( is_array($error) ){
				echo '<li>' . implode( '</li><li>', $error) . '</li>';
			}else{
				echo '<li>' . $error . '</li>';
			}
			echo '</ul>';
		}
	}
}//Class end
	
$obj = new Helper();

?>
