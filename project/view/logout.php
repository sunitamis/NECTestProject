<?php
	session_start();//session starts here
	unset($_SESSION['uname']);//all session variables gets destroyed here
	session_destroy();//session gets destroyed here
	header("location:login.php");//heads to login page
?>
