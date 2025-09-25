<!-- This connects the user data to the database when logging in-->
<?php
$is_invalid = false;
if ($_SERVER["REQUEST_METHOD"] === "POST") 
{
    $mysqli = require __DIR__ . "/Database.php";
    $sql = sprintf("SELECT * FROM users WHERE email = '%s'", $mysqli->real_escape_string($_POST["email"]));
    $result = mysqli_query($mysqli, $sql);
    $user = mysqli_fetch_assoc($result);
    if ($user) 
    {
        if (password_verify($_POST["password"], $user["password_hash"])) 
        {
            session_start();
            session_regenerate_id();
            $_SESSION["users_id"] = $user["id"];
            header("Location: /Home.php");
            exit;
        }
    }
    $is_invalid = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Robotics Login</title>
    <link rel = "stylesheet" href = "Css/style.css">
</head>
<body>
    <script src = "Login_and_Signup.js" defer></script>
    <div class="login-box">
        <h1>Login</h1>
        <form method = "post">
            <label for = "email"> Email:</label>
            <input type = "text" id = "email" name="email" placeholder = "">
            <br>
            <label for = "password"> Password:</label>
            <input type = "text" id = "password" name="password" placeholder = "">
            <br>
            <input type = "submit" value = "Submit" id = "myLogin" style="width: 318px; height: 35px; margin-top: 28px; background-color: #49c1a2; color: white; font-size: 18px;">
        </form>
    </div>
    <p class="para-2">Don't have an account? <a href = "Sign_up.php">Sign Up here</a></p2>
</body>
</html>
