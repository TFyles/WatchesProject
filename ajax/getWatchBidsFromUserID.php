<?php
	
	require_once('../db.php');
	require_once('../classes/bids.classes.php');

	/*make sure request is coming from the ID associated with this session (TF)*/
	if($_COOKIE['PHPSESSID'] == session_id()){
		if ($_POST['ID']) {


			$bidObj = new bid($DBH);
			$bidObj->getBidsFromUserID($_POST['ID']);

		}else{
			echo "Fail";
		}
	}

?>