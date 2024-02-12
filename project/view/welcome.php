<?php
require_once('access.php');
require_once('header.php');
?>
	
<div class="container">
	<header>Welcome <?=$_SESSION['uname']?>!</header>
	<form>
		<div class="button">
		   <div class="inner"></div>
		   <button onclick = "document.location.href='logout.php'">LOGOUT</button>
		</div>
	</form
</div>
			
<?php
require_once('footer.php');
?>

