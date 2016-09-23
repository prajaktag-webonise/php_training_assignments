<?php

include_once('common.php');
/*
 * callToMainLogic : takes no input; contains logic for calling functions after form submit
 *
 */
function callToMainLogic()
{
    if (isset($_POST['string_submit'])) {
        if ($_POST['user_option'] == PHP_BUILT_IN && $_POST['user_input_string'] != '') {
            echo 'String :' . uniqueRevString($_POST['user_input_string']);
        }
        if ($_POST['user_option'] == CUSTOM_FUNCT && $_POST['user_input_string'] != '') {
            echo 'String :' . uniqueRevStringCustom($_POST['user_input_string']);
        }
    }
}

/*
 * uniqueRevString :takes string as input and return unique string after reading string in reverse order
 * using inbuilt function
 */
function uniqueRevString($string){
    $string=strrev($string);
    $unique_string=array_unique(str_split($string));
    $reverse_string=implode("",$unique_string);
    return $reverse_string;
}

/*
 * uniqueRevStringCustom :takes string as input and return unique string after reading string in reverse order;
 * using custom functions
 *
 */
function uniqueRevStringCustom($string){
    //echo 'dfds';
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
<h1>Unique Reverse String</h1>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    Enter string:<input type="text"  name="user_input_string">
    <select name="user_option">
        <option value="0">Select</option>
        <option value="1">PHP Built-in</option>
        <option value="2">Custom Functions</option>
    </select>
    <input type="submit" value="Show String" name="string_submit">
</form>
<a href="index.php">Back to List</a>
</body>
</html>