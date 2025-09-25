<?php
session_start();
include("Database.php");
if(isset($_GET['id']))
{
    $id = $_GET['id'];
}
$mysqli = mysqli_connect("localhost", "root", "", "login_user_data");
$query = "DELETE FROM member_profiles WHERE id = '$id'";
$result = mysqli_query($mysqli, $query);
if(!$result)
{
    die("Query Failed".mysqli_error($mysqli));
}
else
{
    header("location:Home.php?delete_msg=You have deleted a member.");
}
?>