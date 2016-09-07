<?php  
	setcookie("auctionID", $_GET['i']);
  require_once('db.php');
  require_once('classes/images.classes.php');
  require_once('classes/auctions.classes.php');
  require_once('classes/users.classes.php');

  $auctionObj = new auction($DBH);
  $owner = $auctionObj->getOwnerFromID($_GET['i']);
  $userObj = new user($DBH);
  $username = $userObj->getNameFromID($owner['user_ID']);

  // Check if user whos logged in is the user whos owns the auction being edited (TF)

  if($username['username'] == $_SESSION['login_user']){
  require_once('views/addWatchImages.php');
  } else {
    require_once('views/permission.php');
  }



?>



