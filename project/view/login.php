<?php 
include_once("header.php");
?>
<script src="../public/js/login.js"></script>
      <div class="container">
         <header>Login Form</header>
		 <span class = "error_msg"></span>
         <form name = "loginFrm" id = "loginFrm" method = "POST">
            <div class="input-field">
               <input type="text" name = "username" id ="username" >
               <label>Username</label>
            </div>
            <div class="input-field">
               <input class="pswrd" type="password" name = "pwd" id = "pwd" >
               <span class="show">SHOW</span>
               <label>Password</label>
            </div>
            <div class="button">
               <div class="inner"></div>
               <button>LOGIN</button>
            </div>
         </form>
         <div class="signup">
            Not a member? <a href="register.php">Signup Now</a>
         </div>
      </div>

<?php 
include_once("footer.php");
?>