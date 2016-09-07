<?php  
require_once('db.php');
require_once('classes/users.classes.php');

$userObj = new user($DBH);
$username = $userObj->getNameFromID($_GET['i']);
$profile = $_GET['i'];
$_SESSION['ProfilePicUser']= $profile;

// Check if user whos logged in is the user whos being edited to prevent people changing url (TF)
if($username['username'] == $_SESSION['login_user']){
  require_once('views/addProfilePicView.php');
} else {
  require_once('views/permission.php');
}
	


?>



