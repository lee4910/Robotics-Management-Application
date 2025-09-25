<?php
session_start();
include("Database.php");
if(isset($_POST["add_member"]))
{
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $skills = $_POST["skills"];
    $task = $_POST["task"];
    $progress_percentage = $_POST["progress_percentage"];
    $meetings_attended = $_POST["meetings_attended"];
    $suggestions = $_POST["suggestions"];

    if($fname == "" || empty($fname))
    {
        header("location:/Home.php?message=You need to fill in a first name!");
    }
    else if($lname == "" || empty($lname))
    {
        header("location:/Home.php?message=You need to fill in a last name!");
    }
    else
    {
        $mysqli = mysqli_connect("localhost", "root", "", "login_user_data");
        $query = "INSERT INTO member_profiles (fname, lname, skills, tasks, progress_percentage, meetings_attended, suggestions) VALUES ('$fname', '$lname', '$skills', '$task', '$progress_percentage', '$meetings_attended', '$suggestions');";
        $result = mysqli_query($mysqli, $query);
        if(!$result)
        {
            die("Query Failed".mysqli_error($mysqli));
        }
        else
        {
            header("location:Home.php?insert_msg=Data has been added successfully");
        }
    }
}

?>