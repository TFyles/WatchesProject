<?php
	
	require_once('../db.php');
	require_once('../classes/users.classes.php');

	/*make sure request is coming from the ID associated with this session (TF)*/
	if($_COOKIE['PHPSESSID'] == session_id()){
		if ($_POST['get'] == "user" ) {

			$userObj = new user($DBH);
			return $userObj->getProfileFromID($_POST['ID']);

		}else{
			echo "Fail";
		}
	}

?>