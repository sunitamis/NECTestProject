<?php
require_once('../libs/helper.php');

class classLoginController extends Helper
{
	/**
	*@desc Function to validate login data
	*@param $data - Post data
	**/
	public function validateLoginData( $data = array() ){
		$error_msg = [];
		
		$error_msg = array_merge($error_msg, $this -> validateUsername ($data['username']));
		
		$error_msg = array_merge($error_msg, $this -> validatePassword ($data['password']));
		
		if( empty($error_msg) ) {
			return true; 
		}else {
			return $error_msg;
		}
	}
	
	/**
	*@desc Function for login check
	*@param $data - Array parameter contains info like username and password field values
	**/
	public function loginCheck($data = array())
	{	
		if( !empty($data['username']) && !empty($data['password'])){
			$data['post_user'] = mysqli_real_escape_string($this->db, trim($_POST['username']));
			$data['post_pwd']  = mysqli_real_escape_string($this->db, trim($_POST['password']));
			$ans = $this->select('log_pass', 'b_login', "log_user='".$data['post_user']."'");
				
			if($ans === false){
				return "Username is incorrect.";
			}	
			else{
				if($ans[0][0] == sha1($data['post_pwd'])){
					return 1;
				}
				else{
					return "Password is incorrect.";
				}
			}
		}
		return false;
	}

}//Class end
	
$loginControllerObj = new classLoginController();

?>
