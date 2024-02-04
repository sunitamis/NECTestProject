<?php
require_once('connect.php');

class Helper extends Connect
{

	/**
	*@desc Function to upload a file
	*@param $file - Uploaded file
	*@param $path - Field path
	*@return string
	**/	
	public function ImageUpload($file = array(), $filepath = ""){
		if(is_array($file) && !empty($filepath)){
			$imageName = $file['name'];
			$uniqueName = date("d-m-Y").time().$imageName;
			$source = $file['tmp_name'];
			$destination = $filepath.$uniqueName;		
			move_uploaded_file($source,$destination);

			return $uniqueName;
		}
		return false;
	}

	/**
	*@desc Function to insert data in database
	*@param $table - Tablename
	*@param $field - Column name
	*@param $value - Column values
	**/
	public function insert($table = "", $field = "", $value = ""){
		if(!empty($table) && !empty($field) && !empty($value)){
			$sql = "INSERT INTO $table ($field) VALUES ($value)";
			$this->conn->query($sql) or die($this->conn->error);	
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
			$query = "SELECT $field FROM $table WHERE $condition";
			$result = $this->conn->query($query) or die($this->conn->error);
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
		return false;
	}

	/**
	*@desc Function for login check
	*@param $data - Array parameter contains info like username and password field values
	**/
	public function login($data = array())
	{
		if( !empty($data['post_user']) && !empty($data['post_pwd'])){
			$ans = $this->select('log_pass', 'b_login', "log_user='".$data['post_user']."'");
				
			if($ans === false){
				return "Wrong Username";
			}	
			else{
				if($ans[0][0] == sha1($data['post_pwd'])){
					return 1;
				}
				else{
					return "Wrong Password";
				}
			}
		}
		return false;
	}

	/**
	*@desc Function for login check
	*@param $table - Tablename
	*@param $field - Column to be selected
	*@param $condition - Condition
	*@param $name - Field name
	**/
	public function dynamic_dropdown($field, $table, $condition, $name)
	{
		$ans = $this->select($field, $table, $condition);

		if($ans === false)
		{
			echo "<select><option> No data </option></select>";
		}
		else
		{
			echo "<select name='$name' class='$name' id='$name'>";
			foreach($ans as $value)
			{
				echo "<option value='$value[0]'>$value[1]</option>";
			}
			echo "</select>";
		}
	}

	/**
	*@desc Function to check if data passed is numeric
	*@param $data - Data to be validated
	*@param $range - Numeric value range
	**/	
	public function validate_no($data, $range)
	{
		$pattern = "/^[0-9]{".$range."}$/";

		if(!preg_match($pattern,$data))
		{
			return 1;
		}
		else 
		{
			return 0;
		}
	}
		
	/**
	*@desc Function to check if valid email id passed
	*@param $email - Value to be validated
	**/		
	public function validate_email($email)
	{
		$pattern = '/^[a-zA-Z][a-zA-Z0-9_.]+@[a-zA-Z0-9_.]+\.[a-z]{2,4}$/';
		if(!preg_match($pattern,$email))
		{
			return 1;
		} else 
		{
			return 0;
		}
	}
		
	/**
	*@desc Function to check if valid username id passed
	*@param $uname - Value to be validated
	**/			
	public function validate_uname($uname)
	{
		$pattern = '/^[a-zA-Z][a-zA-Z0-9_.]{4,10}$/';
			if(!preg_match($pattern,$uname))
		{
			return 1;
		} else 
		{
			return 0;
		}
	}

	/*
	* @desc Function to execute db query
	* @param $sql - SQL query whichi will get executed
	*/
	public function exe($sql)
	{
		if(!empty($sql)){
			$this->conn->query($sql) or die($this->conn->error);
		}
	}
}//Class end
	
$obj = new Helper();

?>
