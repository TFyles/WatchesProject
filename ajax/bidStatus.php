<?php
	
	require_once('../db.php');
	require_once('../classes/bids.classes.php');

    /*make sure request is coming from the ID associated with this session (TF)*/
    if($_COOKIE['PHPSESSID'] == session_id()){


		$bidObj = new bid($DBH);
		

    	switch ($_POST['type']) {
        case "decline":
            $bidObj->declineBid($_POST['ID']);
            break;
        case "accept":
            $bidObj->cascadeDecline($_POST['ID'], $_POST['auctionID']);
            $bidObj->acceptBid($_POST['ID']);
         	break;
        case "cancel":
            $bidObj->cancelBid($_POST['ID']);
            break;
        default:
            echo "nothing";
        }

    }

?>