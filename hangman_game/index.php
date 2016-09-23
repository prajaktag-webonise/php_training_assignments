<?php
session_start();
$chances=5;
$word='CATALOG';
$altered_word='';

if(isset($_POST['submit'])) {
    if (strpos($_SESSION['alter_string'], '_') !== false) {
        if ($_SESSION['chances'] > 0) {

            if (strpos($word, strtoupper($_POST['hchar'])) !== false) {
                $_SESSION['alter_string'] = replaceChar($_POST['hchar']);
            } else {
                $_SESSION['chances'] = $_SESSION['chances'] - 1;
                echo $_SESSION['chances'].' chances left';
            }
        } else {
            echo 'Game over.Reload page to start a new game';
        }
    }
    else  {
        echo "You Won";
    }
}
else {

    $_SESSION['chances']=5;
}


function convertWordToBlanks($word) {
     if($_SESSION['chances']==5 && !(isset($_POST['submit']))) {
        $count=strlen($word);
        for($i=0;$i<$count;$i++){
            $str[$i]="_";
        }
        $_SESSION['alter_string']=implode(',', $str);
        return implode(',', $str);
    }
    else {
        return $_SESSION['alter_string'];
    }
}

function replaceChar($c) {
    $positions=array();
    $c=strtoupper($c);

    for($i=0; $i<strlen($GLOBALS['word']); $i++) {

        if($GLOBALS['word'][$i] == $c) {
           $positions[]=$i;

        }

    }

    $str=explode(',', $_SESSION['alter_string']);
    foreach($positions as $position) {
        $str[$position] = $GLOBALS['word'][$position];
    }

    $_SESSION['alter_string']=implode(',', $str);
    return $_SESSION['alter_string'];
}


?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Hangman Game</title>
</head>
<body>
<?php echo convertWordToBlanks($word); ?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    Enter a character:<input type="text" maxlength="1" name="hchar">
    <input type="submit" value="Guess" name="submit">
</form>
</body>
</html>

