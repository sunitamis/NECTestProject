<?php
require_once('../libs/helper.php');
if(empty($_POST['username']) || empty($_POST['password'])){
	echo "Please enter all data";
}else{
	$user = mysqli_real_escape_string($obj->conn, trim($_POST['username']));
	$pass = mysqli_real_escape_string($obj->conn, trim($_POST['password']));
	$result = $obj->login(["post_user"=>$user, "post_pwd"=>$pass]);
	
	if($result==1)
	{		
		$user_data = $obj->select("log_id, log_active, log_user","b_login","log_user = '$user'");	
		session_start();
		$_SESSION['uname'] = $user_data[0][2];
		$_SESSION['userid'] = $user_data[0][0];
		$_SESSION['status'] = $user_data[0][1];
		echo 1;
	}
	else
	{
		echo $result;	
	}
}
?>
