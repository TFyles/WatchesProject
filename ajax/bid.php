<?php
	
	require_once('../db.php');
	require_once('../classes/bids.classes.php');

	/*make sure request is coming from the ID associated with this session (TF)*/
	if($_COOKIE['PHPSESSID'] == session_id()){
		if ($_POST['watchID'] && $_POST['userID'] && $_POST['bidAmount']) {


			$bidObj = new bid($DBH);
			$bidObj->addBid($_POST['watchID'],$_POST['userID'], $_POST['bidAmount']);

		}else{
			echo "Fail";
		}
	}

?>