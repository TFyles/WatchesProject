<?php
	
	require_once('../db.php');

	/*Deprecated function(TF)*/
	/*make sure request is coming from the ID associated with this session (TF)*/
	if ($_COOKIE['session-id'] == $_SESSION['session-id']){
		if ($_POST['Session'] == 'get' ) {

			//echo $_SESSION['session-id'];
			echo $_COOKIE['session-id'] . "is the session id";
		}else{
			echo "Fail";
		}
	}else{
		echo "Id's did not match";
	}

?>