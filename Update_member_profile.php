<?php
session_start();
include("Database.php");
global $id;
global $row;
if(isset($_GET['id']))
{
    $id = $_GET['id'];
    $query = "SELECT * FROM member_profiles WHERE id = '$id'";
    $result = mysqli_query($mysqli, $query);
    if(!$result)
    {
        die("Query Failed".mysqli_error($mysqli));
    }
    else
    {
        $row = mysqli_fetch_assoc($result);
    }
}
if(isset($_POST["update_member"]))
{
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $skills = $_POST["skills"];
    $task = $_POST["task"];
    $progress_percentage = $_POST["progress_percentage"];
    $meetings_attended = $_POST["meetings_attended"];
    $suggestions = $_POST["suggestions"];
    $mysqli = mysqli_connect("localhost", "root", "", "login_user_data");
    $query = "UPDATE member_profiles SET fname = '$fname', lname = '$lname', skills = '$skills', tasks = '$task', progress_percentage = '$progress_percentage', meetings_attended = '$meetings_attended', suggestions = '$suggestions' WHERE id = '$id'";
    $result = mysqli_query($mysqli, $query);
    if(!$result)
    {
        die("Query Failed".mysqli_error($mysqli));
    }
    else
    {
        header('location:/Home.php?update_msg=You have successfully updated the data!');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Robotics Update Member</title>
</head>
<body>
    <h1 style = "text-align: center; background-color:#333; color: #fff; padding: 20px; letter-spacing: 2px; font-weight: 500;">Robotics Member Profiles</h1>
    <form method = "post">
    <div class = "form-group">
        <label>First Name</label>
        <input type = "text" name = "fname" class = "form-control" value = "<?php echo $row['fname'] ?>">
    </div>
    <div class = "form-group">
        <label>Last Name</label>
        <input type = "text" name = "lname" class = "form-control" value = "<?php echo $row['lname'] ?>">
    </div>
    <div class = "form-group">
        <label>Skills</label>
        <input type = "text" name = "skills" class = "form-control" value = "<?php echo $row['skills'] ?>">
    </div>
    <div class = "form-group">
        <label>Task(s)</label>
        <input type = "text" name = "task" class = "form-control" value = "<?php echo $row['tasks'] ?>">
    </div>
    <div class = "form-group">
        <label>Percentage of Task Completed (%)</label>
        <input type = "text" name = "progress_percentage" class = "form-control" value = "<?php echo $row['progress_percentage'] ?>">
    </div>
    <div class = "form-group">
        <label>Meetings Attended</label>
        <input type = "text" name = "meetings_attended" class = "form-control" value = "<?php echo $row['meetings_attended'] ?>">
    </div>
    <div class = "form-group">
        <label>Suggestions</label>
        <input type = "text" name = "suggestions" class = "form-control" value = "<?php echo $row['suggestions'] ?>">
    </div>
    <input style = "margin-top: 10px" type = "submit" class = "btn btn-success" name = "update_member" value = "Update">
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

