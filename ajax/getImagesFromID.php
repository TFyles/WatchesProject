<?php
	
	require_once('../db.php');
	require_once('../classes/images.classes.php');

	/*make sure request is coming from the ID associated with this session (TF)*/
	if($_COOKIE['PHPSESSID'] == session_id()){
		if ($_POST['ID']) {


			$imgObj = new image($DBH);
			$imgObj->getImagesFromID($_POST['ID']);

		}else{
			echo "Fail";
		}
	}

?>