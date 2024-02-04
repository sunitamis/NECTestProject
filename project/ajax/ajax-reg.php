<?php
require_once("../libs/helper.php");

if(empty($_REQUEST['user']))
{
	echo "Please enter Username";
}
else
{
	$userdata = mysqli_real_escape_string($obj->conn, trim($_REQUEST['user']));
	$ans = $obj->select("count(*)","b_login","log_user='$userdata'");
	if($ans[0][0] >= 1)
	{
		echo 1;
	}
	else
	{
		echo 2;
	}
}
?>
