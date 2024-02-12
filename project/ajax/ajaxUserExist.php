<?php
require_once('../controller/classRegisterController.php');

$regControllerObj -> checkUsernameTaken( $_POST['user'] );

?>
