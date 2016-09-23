<?php
include("config.php");

/*
 * This function contains logic after form save
 */
function submitLoginForm()
{   session_start();
    if (isset($_POST['logIn'])) {

        $dbConnect = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        $email = mysqli_real_escape_string($dbConnect, $_POST['email']);
        $password = mysqli_real_escape_string($dbConnect, $_POST['password']);

        $sql = "SELECT user_id FROM users WHERE email = '$email' and user_pass = md5('$password')";
        $result = mysqli_query($dbConnect, $sql);
        $count = mysqli_num_rows($result);
        if ($count == 1) {
            $_SESSION['loginUser'] = $email;

            header("location: welcome.php");
        } else {
            $error = "Your Email or Password is invalid";
            echo $error;
        }

        mysqli_close($dbConnect);
    }
}
submitLoginForm();
?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
    Email: <input type="email" name="email"> <br>
    Password: <input type="password" name="password"> <br>
    <input type="submit" value="Log In" name="logIn">
    <h4><a href = "sign_up.php">Sign Up</a></h4>
</form>