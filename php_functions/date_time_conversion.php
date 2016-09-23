<?php
/*
 * Function for  program logic
 */
function callToMainLogic()
{
    if (isset($_POST['uk'])) {
        echo convertToUk($_POST['dtime']);
    }
    if (isset($_POST['us'])) {
        echo convertToUS($_POST['dtime']);
    }
}
/*
 * convertToUS :takes data and time string and converts it into US data and Time
 *
 */
function convertToUS($date_time){
    $date_time = new DateTime($date_time);
    $la_time = new DateTimeZone('America/New_York');
    $date_time->setTimezone($la_time);
    return $date_time->format('Y-m-d H:i:s');
}
/*
 * convertToUk :takes data and time string and converts it into UK data and Time
 *
 */
function convertToUk($date_time){
    $datetime = new DateTime($date_time);
    $la_time = new DateTimeZone('Europe/London');
    $datetime->setTimezone($la_time);
    return $datetime->format('Y-m-d H:i:s');
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
<h1>Date & Time Converter</h1>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    Select Date and Time:<input type="datetime-local"  name="dtime">
    <select name="user_option">
<!--        <option value="0">Select</option>-->
        <option value="1">PHP Built-in</option>
<!--        <option value="2">Custom Functions</option>-->
    </select>
    <input type="submit" value="Convert to UK" name="uk">
    <input type="submit" value="Convert to US" name="us">
</form>
<a href="index.php">Back to List</a>
</body>
</html>