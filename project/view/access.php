<?php

//After login if client wants to head again to register or login page it checks whether the session variable is set or not, if set
session_start();
if(!isset($_SESSION['uname']))
{
	header("location:logout.php");
}

require_once('../libs/helper.php');
?>
