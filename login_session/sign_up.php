<?php
include("config.php");

/*
 * This function contains logic after form save
 */
function submitSignUpForm()
{    if (isset($_POST['signUp'])) {

        $dbConnect = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        $email = mysqli_real_escape_string($dbConnect, $_POST['email']);
        $firstName = mysqli_real_escape_string($dbConnect, $_POST['firstName']);
        $password = mysqli_real_escape_string($dbConnect, $_POST['password']);
        $confirmPassword = mysqli_real_escape_string($dbConnect, $_POST['confirmPassword']);
        if($confirmPassword!==$password) {
            echo 'Password does not match';
            exit;
        }
        $hashedPassword=md5($password);
        $sql= "INSERT INTO users (email, first_name, user_pass) VALUES ('$email', '$firstName','$hashedPassword')";
        $result = mysqli_query($dbConnect, $sql);
        if($result) {

           echo "Success";
            echo '<h4><a href = "index.php">Log In</a></h4>';
        } else {
            $error = "Your Email or Password is invalid";
            echo $error;
        }

        mysqli_close($dbConnect);
    }
}
submitSignUpForm();
?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
    Email: <input type="email" name="email"> <br>
    First Name: <input type="text" name="firstName"> <br>
    Password: <input type="password" name="password"> <br>
    Confirm Password: <input type="password" name="confirmPassword"> <br>
     <input type="submit" value="Sign Up" name="signUp">
</form>