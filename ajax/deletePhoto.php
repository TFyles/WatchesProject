<?php
	
	require_once('../db.php');
	require_once('../classes/images.classes.php');



	if ($_POST['ID']) {


		$imgObj = new image($DBH);
		$imgObj->deletePhoto($_POST['ID']);

	}else{
		echo "Fail";
	}

?>