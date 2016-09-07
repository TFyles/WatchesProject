<?php
	
	require_once('../db.php');
	require_once('../classes/users.classes.php');



	if ($_POST['username'] && $_POST['pass']) {

		$password = $_POST['pass'];
		$userObj = new user($DBH);
		return $userObj->login($_POST['username'], $password);

	}else{
		echo "Fail";
	}

?>