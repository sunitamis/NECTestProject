$(document).ready(function(){
	var $theForm = $( '#loginFrm' );

	$( '#loginFrm' ).validate({
        rules: {
            username: "required",
            pwd: "required"
        },errorPlacement: function(error, element) {},
		submitHandler: function () {
			if($theForm.valid()){
				submitLoginFrm(); //submitting the form
			}
        }
	});
	
	function submitLoginFrm(){
		$(".error_msg").fadeIn();
		var a = $("#username");
		var b = $("#pwd");
		var str = "username="+$.trim(a.val())+"&password="+$.trim(b.val());

		$.ajax({
			type:"POST",
			data:str,
			url:"../ajax/ajax-login.php",
			success:function(response){
			if(response==1){
				window.location.href="../view/welcome.php";
			}
			else{		
				$(".error_msg").html(response).fadeOut(9000);
				a.val("");
				b.val("");			
			}
			}		

		});	
	}

});
