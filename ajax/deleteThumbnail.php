<?php
	
	require_once('../db.php');
	require_once('../classes/auctions.classes.php');



	if ($_POST['ID']) {


		$auctionObj = new auction($DBH);
		$auctionObj->deleteThumbnail($_POST['ID']);

	}else{
		echo "Fail";
	}

?>