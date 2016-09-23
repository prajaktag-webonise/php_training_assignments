<?php
include_once('common.php');
/*
 * callToMainLogic function takes no parameter
 * It checks for user option and file extension and calls custom or php inbuilt function accordingly
 *
 */
function callToMainLogic()
{
    if (isset($_POST['filename'])) {
        if ($_POST['user_option'] == PHP_BUILT_IN && $_POST['file_ext'] != '') {
            echo 'Extension :' . getFileExtension($_POST['file_ext']);
        } else if ($_POST['user_option'] == CUSTOM_FUNCT && $_POST['file_ext'] != '') {
            echo 'Extension :' . getFileExtensionCustom($_POST['file_ext']);
        } else {
            echo 'Please enter and select a valid option';
        }

    }
}
/*
 * getFileExtension: takes filename as input and returns file extension
 *
 */
function getFileExtension($filename)
{
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    return $extension;
}
/*
 * getFileExtensionCustom:takes filename as input and returns file extension
 *
 */
function getFileExtensionCustom($filename) {
        $extension="";
    $container="";
        $len=customStringLength($filename);
        for($counter=$len;$counter>0;$counter--){
            if($filename[$counter]=='.') {
                break;
            }
            else {
                $container .=$filename[$counter];
                continue;
                  }
        }
        $new_length = customStringLength($container);
        for($j=$new_length;$j>=0;$j--) {
            $extension .=$container[$j];
        }

    return $extension;
}
/*
 * customStringLength : Finds length of string
 * Takes string as input and returns numeric value
 */
function customStringLength($string)
{
    $counter = 0;
    while ($string[$counter] != '') {
        $counter++;
    }
    return $counter;
}
callToMainLogic();
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>PHP Functions</title>
</head>
<body>
<h1>Finding File Extension</h1>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    Enter filename:<input type="text"  name="file_ext">
    <select name="user_option">
        <option value="0">Select</option>
        <option value="1">PHP Built-in</option>
        <option value="2">Custom Functions</option>
    </select>
    <input type="submit" value="Find File Extension" name="filename">
</form>
<a href="index.php">Back to List</a>
</body>
</html>
