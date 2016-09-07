<?php
	
	require_once('../db.php');
	require_once('../classes/auctions.classes.php');

	/*make sure request is coming from the ID associated with this session (TF)*/
	if($_COOKIE['PHPSESSID'] == session_id()){
		if ($_POST['get'] == "Auctions" ) {


			$auctionObj = new auction($DBH);
			$auctionObj->getAllAuctions();

		}else{
			echo "Fail";
		}
	}

?>