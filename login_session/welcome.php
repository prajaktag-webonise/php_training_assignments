<?php
/*
 * checks if user is logged on; otherwise returns to login page
 */
function checkUserLoggedIn()
{
    session_start();
    if (!isset($_SESSION['loginUser'])) {
        header("location:index.php");
    }
}
checkUserLoggedIn();

?>

<html">

   <head>
      <title>Welcome </title>
   </head>

   <body>
      <h1>Welcome <?php echo $_SESSION['loginUser']; ?></h1>
      <h4><a href = "logout.php">Sign Out</a></h4>
   </body>

</html>