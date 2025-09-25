<!-- This is for making sure the right parameters are entered in when signing up-->
<?php
$is_invalid = false;
$signuperr = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") 
{
    if (empty($_POST["fname"])) 
    {
        $signuperr = "First name is required";
    }
    else if (empty($_POST["lname"])) 
    {
        $signuperr = "Last name is required";
    }
    else if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) 
    {
        $signuperr = "Valid email is required";
    }
    else if (strlen($_POST["npassword"]) < 8) 
    {
        $signuperr = "Password must be at least 8 characters";
    }
    else if ( ! preg_match("/[a-z]/i", $_POST["npassword"])) 
    {
        $signuperr = "Password must contain at least one letter";
    }
    else if ( ! preg_match("/[0-9]/", $_POST["npassword"])) 
    {
        $signuperr = "Password must contain at least one number";
    }
    else if ($_POST["npassword"] !== $_POST["cpassword"]) {
        $signuperr = "Passwords must match";
    }
    else
    {
        $mysqli = require __DIR__ . "/Database.php";
        $sql = sprintf("SELECT * FROM users WHERE email = '%s'", $mysqli->real_escape_string($_POST["email"]));  
        $result = mysqli_query($mysqli, $sql);
        if(mysqli_num_rows($result) !== 0)
        {
            $signuperr = "An account exists with this email already";
        }
        else
        {
            $fname = $_POST["fname"];
            $lname = $_POST["lname"];
            $email = $_POST["email"];
            $password_hash = password_hash($_POST["npassword"], PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (fname, lname, email, password_hash) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($mysqli);
            mysqli_stmt_prepare($stmt, $sql);
            mysqli_stmt_bind_param($stmt, "ssss", $fname, $lname, $email, $password_hash);
            mysqli_stmt_execute($stmt);
            header("Location: Sign_up_success.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Robotics Sign Up</title>
    <link rel = "stylesheet" href = "Css/style.css">
</head>
<body>
    <div class="signup-box">
        <h1>Sign Up</h1>
        <em style="text-align: center; color:red;"><?php echo $signuperr;?></em>
        <form method = "post">
            <label for = "fname"> First name:</label>
            <input type = "text" id = "fname" name="fname" placeholder = "">
            <br>
            <label for = "lname"> Last name:</label>
            <input type = "text" id = "lname" name="lname" placeholder = "">
            <br>
            <label for = "email"> Email:</label>
            <input type = "text" id = "email" name="email" placeholder = "">
            <br>
            <label for = "npassword"> New Password:</label>
            <input type = "text" id = "npassword" name="npassword" placeholder = "">
            <br>
            <label for = "cpassword"> Confirm Password:</label>
            <input type = "text" id = "cpassword" name="cpassword" placeholder = "">
            <br>
            <input type = "submit" value = "Submit" id = "mySignUp">
        </form>
    </div>
    <p class="para-1">Already have an account? <a href = "Login.php">Login here</a></p>
</body>
</html>