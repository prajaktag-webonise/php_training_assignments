<?php
/*
 * logs out user by destroying session
 */
function logOutUser()
{
    session_start();

    if (session_destroy()) {
        header("Location: index.php");
    }
}
logOutUser();
?>