<?php
require_once('../libs/helper.php');

class classRegisterController extends Helper
{
	/**
	*@desc Function to check if username already exist
	*@param $data - Post data
	*@param $return - 0 = Echo value, 1 = Return value
	**/
	public function checkUsernameTaken( $data = array(), $return = 0 ){
		$result = 0;
		if( !empty($data) ){
			$userdata = mysqli_real_escape_string($this->db, trim($data));
			$ans = $this->select("count(*)", "b_login", "log_user='$userdata'");
			if($ans[0][0] >= 1)
			{
				$result = 1;
			}
		}
		
		if($return){
			return $result;
		}else{
			echo $result;
		}
	}
	
	/**
	*@desc Function to validate registration form data
	*@param $data - Post data
	**/
	public function validateRegData( $data = array(), $file = array() ){
		$error_msg = [];
		
		//Validate Username
		$error_msg = array_merge($error_msg, $this -> validateUsername ($data['username']));
		
		//Check if username already exist
		$userTaken = $this-> checkUsernameTaken($data['username'], 1);
		if($userTaken == 1){
			$error_msg[] = "Username already exist.";
		}
		
		//Validate Password
		$error_msg = array_merge($error_msg, $this -> validatePassword ($data['pwd']));
		
		//Validate Confirm Password
		$error_msg = array_merge($error_msg, $this -> validatePassword ($data['confirm_pwd'], 1));
		
		//Check if Password and Confirm password match
		$error_msg = array_merge($error_msg, $this -> checkPasswordMatch ($data['pwd'], $data['confirm_pwd']));

		//Validate Email Id
		$error_msg = array_merge($error_msg, $this -> validateEmail ($data['email']));

		//Validate Captcha
		$error_msg = array_merge($error_msg, $this -> validateCaptcha ($data['captcha']));

		//Validate Uploaded Image
		$error_msg = array_merge($error_msg, $this -> validateImage ($file['photo']));

		if( empty($error_msg) ) {
			return true; 
		}else {
			return $error_msg;
		}
	}
	
	/**
	*@desc Function to validate uploaded file
	*@param $file - Uploaded file
	*@return string/bool
	**/	
	public function validateImage( $file = array() ){
		$error_msg = [];
		if(empty($file['name'])){
			$error_msg[] = "Please upload a file.";
		}else{
			if($file['size'] > 2097152 || $file['size'] == 0){//Condition to check the file size 
				$error_msg[] = "Max 2MB filesize is allowed to upload.";
			}
		}
		return $error_msg;
	}
	
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
	*@desc Function for login check
	*@param $data - Array parameter contains info like username and password field values
	**/
	public function signUp($data = array(), $file = array())
	{	
		//Upload the Image
		$dest_folder = "../upload/";
		$image_name = $this->ImageUpload($file['photo'], $dest_folder);
		
		//Convert the password to sha1 hash string
		$converted_pass = sha1($data['pwd']);
		
		//Insert data in table
		$table = "b_login";
		$field = "log_user, log_pass, log_email, log_image";
		$values = "'".$data['username']."', '".$converted_pass."','".$data['email']."','".$image_name."'";
		$this->insert($table, $field, $values);
		
		//unset the captcha session var which we created for verification as it is not in use now.
		unset( $_SESSION['captcha_code'] );
		
		return true;
	}

}//Class end
	
//Instantiate an class object for this class
$regControllerObj = new classRegisterController();

?>
