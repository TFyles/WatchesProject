<?php
	
	require_once('../db.php');
	require_once('../classes/auctions.classes.php');

    /*make sure request is coming from the ID associated with this session (TF)*/
    if($_COOKIE['PHPSESSID'] == session_id()){

    	$auctionObj = new auction($DBH);

    	switch ($_POST['type']) {
        case "Year":
            $auctionObj->getAuctionByYear($_POST['year']);
            break;
        case "Movement":
            $auctionObj->getAuctionByMovement($_POST['movement']);
            break;
        case "Strap":
            $auctionObj->getAuctionByStrap($_POST['strap']);
            break;
        case "Brand":
            $auctionObj->getAuctionByBrand($_POST['brand']);
            break;
        case "Seller":
            $auctionObj->getAuctionBySellerID($_POST['ID']);
            break;
        default:
            echo "nothing";
        }
    }

	

?>