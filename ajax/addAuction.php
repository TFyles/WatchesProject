<?php
	
	require_once('../db.php');
	require_once('../classes/auctions.classes.php');

	/*make sure request is coming from the Session ID associated with this session (TF)*/
	if($_COOKIE['PHPSESSID'] == session_id()){
		if ($_POST['brand'] && $_POST['model'] && $_POST['year'] && $_POST['movement'] && $_POST['strap'] && $_POST['price'] && $_POST['description'] && $_POST['end_date'] && $_POST['user']) {

		$user = $_POST['user'];
		$date= $_POST['end_date'];
		$format_Date = date("Y-m-d", strtotime($date));
		$auctionObj = new auction($DBH);
		$auctionObj->addAuction($user, $_POST['brand'],$_POST['model'],$_POST['year'],$_POST['movement'],$_POST['strap'], $_POST['price'], $_POST['description'], $format_Date );

		}else{
			echo "Fail";
		}
	}

?>