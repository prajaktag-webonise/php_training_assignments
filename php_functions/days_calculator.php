<?php

include_once('common.php');
/*
 * callToMainLogic : takes no input; contains logic for calling functions after form submit
 *
 */
function callToMainLogic()
{
    if (isset($_POST['calculate'])) {
        if ($_POST['user_option'] == PHP_BUILT_IN && $_POST['date1'] != '' && $_POST['date2'] != '') {
            echo 'Number of days between ' . $_POST['date1'] . ' and ' . $_POST['date2'] . ' in days :';
            echo calcDays($_POST['date1'], $_POST['date2']);

        } else if ($_POST['user_option'] == CUSTOM_FUNCT && $_POST['date1'] != '' && $_POST['date2'] != '') {
            echo 'Number of days between ' . $_POST['date1'] . ' and ' . $_POST['date2'] . ' in days :';
            echo calcDaysCustom($_POST['date1'], $_POST['date2']);

        } else {
            echo 'Please enter all values and select options properly';
        }
    }
}
/*
 * calcDays takes 2 dates as input and returns number of days between using in built functions
 *
 */
function calcDays($date1,$date2) {
    $first_date=date_create($date1);
    $second_date=date_create($date2);
    $diff=date_diff($first_date,$second_date);
    return $diff->format("%R%a days");
}

/*
 * calcDaysCustom :takes 2 dates as input and returns the days between using difference in time (seconds)
 *
 */
function calcDaysCustom($date1, $date2) {

    $start_ts = strtotime($date1);

    $end_ts = strtotime($date2);

    $diff = $end_ts - $start_ts;

    return round($diff / 86400).' days';

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
<h1>Days Calculator</h1>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    Select First Date:<input type="date"  name="date1">
    Select Second Date:<input type="date"  name="date2">
    <select name="user_option">
        <option value="0">Select</option>
        <option value="1">PHP Built-in</option>
                <option value="2">Custom Functions</option>
    </select>
    <input type="submit" value="Calculate" name="calculate">

</form>
<a href="index.php">Back to List</a>
</body>
</html>