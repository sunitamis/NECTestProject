$(document).ready(function ()
{
	let err_msg = "";
/*******************Validation for Username field************************/
var user = $("#username");

function check_user(){
	var value = user.val();
	if(value==""){
		err_msg += "<li>Username is required</li>";
		user.addClass("error");
	}
	else if(user.val().length<=4)
	{
		err_msg += "<li>Username is not valid</li>";
		user.addClass("error");
	}
	else
	{	
		var str = "user="+value;			
		$.ajax({
			type:"POST",
			data:str,
			url:"../ajax/ajaxUserExist.php",
			success:function(response){
				if(response==1)
				{
					err_msg += "<li>Username already exist</li>";
					user.addClass("error");
					return false;			
				}
				else
				{
					user.removeClass("error");
					return true;
				}
			}			
		});
	}	
	return false;
}

/*******************Validation for Email Id field************************/
var email = $("#email");

function check_email(){
	var emailPattern = /^[a-zA-Z][a-zA-Z0-9_.]+@[a-zA-Z0-9_.]+\.[a-z]{2,4}$/;
	var value4 = email.val();
	if(value4==""){
		err_msg += "<li>User email is required.</li>";
		email.addClass("error");
	}
	else if(!emailPattern.test(value4)){
		err_msg += "<li>Invalid Email.</li>";
		email.addClass("error");
	}
	else
	{
		email.removeClass("error");
		return true;
	}		
	return false;		
}

/*******************Validation for Password field************************/
var pass = $("#pwd");

function check_pass(){
	var value1 = pass.val();
	if(value1==""){
		err_msg += "<li>Password field is Empty</li>";
		pass.addClass("error");
	}
	else if(pass.val().length < 8)
	{
		err_msg += "<li>Password should be of atleast 8 characters</li>";
		pass.addClass("error");
	}		
	else
	{
		pass.removeClass("error");
		return true;
	}
	return false;
}
			
/*******************Validation for Confirm Password field************************/
var cpass = $("#confirm_pwd");

function check_cpass()
{
	var value2 = cpass.val();
	if(value2==""){
		err_msg += "<li>Confirm Password field cannot be empty</li>";
		cpass.addClass("error");				
	}
	else if(cpass.val()!=pass.val())
	{
		err_msg += "<li>Password did not match.</li>";
		cpass.addClass("error");
	}
	else
	{
		cpass.removeClass("error");
		return true;	
	}	
	return false;
}

/*******************Validation for Captcha field************************/
var captcha = $("#captcha");
var hcaptcha = $("#hcaptcha");

function check_captcha()
{
	var value3 = captcha.val();
	
	if(value3==""){
		err_msg += "<li>Captcha is required.</li>";
		captcha.addClass("error");				
	}
	else if(isNaN(value3))
	{
		err_msg += "<li>Captcha field should be numeric.</li>";
		captcha.addClass("error");
	}		
	else if(captcha.val()!=hcaptcha.val())
	{
		err_msg += "<li>Invalid Captcha. Re-enter Captcha</li>";
		captcha.addClass("error");
	}
	else
	{
		captcha.removeClass("error");
		return true;	
	}		
	return false;
}

/*******************Validation for Upload File field************************/
var data = $("#photo");

function check_image()
{
	var imageName = data.val();
	var image_data = imageName.split(".");
	var count = image_data.length;
	var ext = image_data[count-1];
	ext = ext.toLowerCase();
	if(imageName=="")
	{
		err_msg += "<li>No Image Uploaded.</li>";
	}
	else if(ext=="jpg"||ext=="jpeg"||ext=="png"||ext=="gif")
	{
		return true;	
	}
	else
	{
		err_msg += "<li>JPG,JPEG,GIF or PNG format files can only be uploaded</li>";
		$("#ff").addClass("texterror").html("JPG,JPEG,GIF or PNG format files can only be uploaded");
	}
		return false;
}

/*******************Validation for Register Button ************************/	
	$("#register").click(function (){		
		check_user();
		check_email();
		check_pass();
		check_cpass();
		check_captcha();
		check_image();
		
		if( err_msg == "" ){
			submitRegForm();
		}else{
			$(".error_msg").html(err_msg);
				err_msg = "";
				return false;
		}
		return true;
	});	

	function submitRegForm(){
		event.preventDefault();
		$(".error_msg").fadeIn();
		
		var form = $('#signupFrm')[0];
        var formData = new FormData(form);
		
		$.ajax({
			type:"POST",
			data:formData,
			url:"../view/register-action.php",
			processData: false,
			contentType: false,
			success:function(response){

				if(response==1){
					window.location.href="../view/login.php";
				}
				else{					
					$(".error_msg").html(response).fadeOut(9000);		
				}
			}		
		});	
	}
});

