<?php 
if(session_id() === "") session_start();
include_once("header.php");
?>
<script src="../public/js/register.js" type="text/javascript"></script>

<div class="container">
	<header>SignUp</header>
	<span class = "error_msg"></span>
	<form name = "signupFrm" id = "signupFrm" method = "POST" enctype='multipart/form-data' formnovalidate>
	<div class="input-field">
	   <input type="text" name = "username" id ="username" >
	   <label>Username</label>
	</div>
	<div class="input-field">
	   <input type="text" name = "email" id ="email">
	   <label>Email</label>
	</div>
	<div class="input-field">
	   <input type="password" name = "pwd" id = "pwd" >
	   <label>Password</label>
	</div>
	<div class="input-field">
	   <input class="pswrd" type="password" name = "confirm_pwd" id = "confirm_pwd" >
	   <span class="show">SHOW</span>
	   <label>Confirm Password</label>
	</div>
	<div class="input-field">
	<?php
		$a=rand(1,9);
		$b=rand(1,9);
		$_SESSION['captcha_code'] = $c = $a*$b;
	?>
	   <input type="text" name = "captcha" id = "captcha" >
	   <input type="hidden" name = "hcaptcha" id = "hcaptcha" value = "<?=$c?>" >
	   <label>Captcha : <?= "$a * $b"?></label>
	</div>
	<div class="input-field">
	   <input type="file" name = "photo" id ="photo" >
	   <label></label>
	</div>
	
	<div class="button">
	   <div class="inner"></div>
	   <button id = "register">SIGNUP</button>
	</div>
	</form>
	<div class="signup">
	Already a member? <a href="login.php">Login Now</a>
	</div>
</div>


<?php 
include_once("footer.php");
?>