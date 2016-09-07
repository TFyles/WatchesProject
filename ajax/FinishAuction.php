<?php
	
	require_once('../db.php');
	require_once('../classes/auctions.classes.php');

	/*make sure request is coming from the ID associated with this session (TF)*/
	if($_COOKIE['PHPSESSID'] == session_id()){
		if ($_POST['ID'] && $_POST['buyerID']) {


			$auctionObj = new auction($DBH);
			$auctionObj->FinishAuction($_POST['ID'], $_POST['buyerID']);

		}else{
			echo "Fail";
		}
	}

?>