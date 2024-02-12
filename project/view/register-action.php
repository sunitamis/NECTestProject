<?php
require_once('../controller/classRegisterController.php');

$valid = $regControllerObj -> validateRegData($_POST, $_FILES);

if( $valid === true ){
	
	$result = $regControllerObj -> signUp($_POST, $_FILES);

	if( $result ){
		echo 1;
	}else{
		$regControllerObj -> showError( "Something went wrong.." );
	}
}
else
{
	$regControllerObj -> showError( $valid ); 
}
?>
