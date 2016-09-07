<?php

/* Code based on the Dropzone.JS guide for implementation in a PHP Backend http://www.startutorial.com/articles/view/how-to-build-a-file-upload-form-using-dropzonejs-and-php 

Changes Include:
- Directory Information
-Adding Salt to image names to prevent duplication
- Code to send to database
(TF)
*/

require_once('db.php');
require_once('classes/auctions.classes.php');


$ds          = DIRECTORY_SEPARATOR; 
 
$storeFolder = 'uploads/thumbs';   
 
if (!empty($_FILES)) {
     
	$id = $_COOKIE['auctionID'];
    $tempFile = $_FILES['file']['tmp_name'];                 
      
    $targetPath = $storeFolder . $ds; 
     
    $fileloc = md5(uniqid(rand(), true)).$_FILES['file']['name'];

     
    $targetFile =  $targetPath. $fileloc;  
 
    move_uploaded_file($tempFile,$targetFile);

    $auctionObj = new auction($DBH);
    $auctionObj->addThumbImagetoID($id, $targetFile);

    echo $tempFile . " And " . $targetFile . "Target path = " . $targetPath . " For ". $id;
     
}
?>  
