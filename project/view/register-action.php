<?php
require_once('../libs/helper.php');
$user=$_POST["username"];
$pass=$_POST["pwd"];
$email=$_POST["email"];
$file=$_FILES["photo"];
$captcha=$_POST["captcha"];
//echo "Username:".$user."</br>"."Password:".$pass."</br>"."Email:".$email."</br>"."Captcha:".$captcha."</br>";
//echo "<pre>";
//print_r($file);
if($file['size']<2097152 && $file['size']>0)//Condition to check the file size 
{
	//File Upload Function
	$imageName = $obj->ImageUpload($file,"../upload/");
	$pass = sha1($pass);
/*sha1 and md5 are form of encryption used to send data in a secure way*/
	$obj->insert("b_login","log_user,log_pass,log_email,log_image","'$user','$pass','$email','$imageName'");
	header("location:login.php");
}
else
{
	echo "Max 2MB File size is allowed to be uploaded";
}
?>
