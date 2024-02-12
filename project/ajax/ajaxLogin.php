<?php
require_once('../controller/classLoginController.php');

$valid = $loginControllerObj->validateLoginData( $_POST );

if( $valid === true ){

	$result = $loginControllerObj->loginCheck( $_POST );
	
	if($result==1)
	{		
		$user_data = $loginControllerObj->select("log_id, log_active, log_user","b_login","log_user = '".$_POST['username']."'");	
		session_start();
		$_SESSION['uname'] = $user_data[0][2];
		$_SESSION['userid'] = $user_data[0][0];
		$_SESSION['status'] = $user_data[0][1];
		echo 1;
	}
	else
	{
		$loginControllerObj -> showError( $result ); 
	}
}else{
		$loginControllerObj -> showError( $valid ); 
}
exit;
?>
