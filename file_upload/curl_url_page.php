<?php
include_once 'pdo_classes.php';
include_once 'file_upload_classes.php';
$pdoObject = new mySql();
$connection = $pdoObject->connectToDb();
$name = urldecode($_POST['name']);
$email = urldecode($_POST['email']);

$pdoObject->insertUser($connection, $name, $email);
$userId=$pdoObject->findUserId($connection,$email);

for($fileCounter = 0; $fileCounter < count($_FILES["file"]["name"]); $fileCounter++){
        $fileTempName = $_FILES["file"]["tmp_name"][$fileCounter];
        $type=$_FILES["file"]["type"][$fileCounter];
        $fileName= $_FILES['file']['name'][$fileCounter];
        $fileSize=$_FILES['file']['size'][$fileCounter];
        $filePath=fileUploadImages($fileTempName, $fileName,$fileSize);
        if($filePath) {
            $pdoObject->insertFileData($connection,$userId,$filePath,$type);
        }
        
}