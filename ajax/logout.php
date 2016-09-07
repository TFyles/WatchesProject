<?php
	
	require_once('../db.php');




	if ($_POST['state'] == 'Logout' ) {

		/* Remove session variables and destory session on logout */
		$_SESSION = array();
		session_destroy();
		echo "sessionOver";

	}else{
		echo "Fail";
	}

?>