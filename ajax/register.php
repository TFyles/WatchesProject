<?php
	//Require the phpMailer files downloaded from composer (tf)
	// phpMailer available from https://github.com/PHPMailer/PHPMailer (tf)
	require_once "../vendor/autoload.php";
	require_once('../db.php');
	require_once('../classes/users.classes.php');



	if ($_POST['username'] && $_POST['pass'] && $_POST['email']) {

		$password = $_POST['pass'];
		/*Hash password before uploading to database (tf)*/
		$hash = password_hash($password, PASSWORD_BCRYPT);
		$userObj = new user($DBH);
		$userObj->addUser($_POST['username'], $hash , $_POST['email'], $_POST['role']);

	}else{
		echo "Fail";
	}

?>