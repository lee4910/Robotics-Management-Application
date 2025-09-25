<?php
session_start();
include("Database.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Robotics Home</title>
    <link rel = "stylesheet" href = "Css/style2.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <div style = "float: left; align-items: center; width: 320px; height: 840px; background:blue; border-radius: 3px; top: 160px;">
        <a href = "Logout.php">
        <button id = "myLogout" style = "color: #fff; letter-spacing: 2px; font-weight: 500; justify-content: center; align-items: center; width: 318px; height: 35px; margin-top: 28px; background-color: aqua; color: black; font-size: 18px;">Logout</button>
        </a>
        <br>
        <a href = "whiteboard/public">
        <button id = "ref-whiteboard" style = "color: #fff; letter-spacing: 2px; font-weight: 500; justify-content: center; align-items: center; width: 318px; height: 316px; margin-top: 28px; background-color: aqua; color: black; font-size: 50px;">Whiteboard</button>
        </a>
    </div>
    <h1 style = "text-align: center; background-color:#333; color: #fff; padding: 20px; letter-spacing: 2px; font-weight: 500;">Robotics Member Profiles</h1>
    <div>
        <h2 style = "float: left; margin-left: 5px;">All Members</h2>
        <button class = "btn btn-primary" style = "margin-right: 5px; margin-bottom: 10px; float: right;" data-bs-toggle = "modal" data-bs-target = "#addMember" >Add Member</button>
    </div>
    <div style = "float:left; align-items: center; width: 1324px; height: 700px; background:rgb(232,232,232); border-radius: 3px; top: 160px;">
        <table class ="table table-hover table-bordered table-striped"style = "margin-left: auto; margin-right: auto;">
            <thread>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Skills</th>
                    <th>Task(s)</th>
                    <th>Percentage of Task Completed (%)</th>
                    <th>Meetings Attended</th>
                    <th>Suggestions</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thread>
            <tbody>
                <?php
                $query = "SELECT * FROM member_profiles";
                $result = mysqli_query($mysqli, $query);
                if(!$result)
                {
                    die("Query Failed".mysqli_error($mysqli));
                }
                else
                {
                    while($row = mysqli_fetch_assoc($result))
                    {
                        ?>
                        <tr>
                            <td><?php echo $row['fname'] ?></td>
                            <td><?php echo $row['lname'] ?></td>
                            <td><?php echo $row['skills'] ?></td>
                            <td><?php echo $row['tasks'] ?></td>
                            <td><?php echo $row['progress_percentage'] ?></td>
                            <td><?php echo $row['meetings_attended'] ?></td>
                            <td><?php echo $row['suggestions'] ?></td>
                            <td><a href ="Update_member_profile.php?id=<?php echo $row['id'] ?>" class = "btn btn-success">Update</a></td>
                            <td><a href ="Delete_member_profile.php?id=<?php echo $row['id'] ?>" class = "btn btn-danger">Delete</a></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
        <?php
        if(isset($_GET['message']))
        {
            echo "<h6>".$_GET['message']."</h6>";
        }
        ?>
        <?php
        if(isset($_GET['insert_msg']))
        {
            echo "<h6>".$_GET['insert_msg']."</h6>";
        }
        ?>
        <?php
        if(isset($_GET['update_msg']))
        {
            echo "<h6>".$_GET['update_msg']."</h6>";
        }
        ?>
        <?php
        if(isset($_GET['delete_msg']))
        {
            echo "<h6>".$_GET['delete_msg']."</h6>";
        }
        ?>
        <!-- Modal -->
        <form action = Add_member_profile.php method = "post">
        <div class="modal fade" id="addMember" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Member</h5>
                    </div>
                    <div class="modal-body">
                        <div class = "form-group">
                            <label>First Name</label>
                            <input type = "text" name = "fname" class = "form-control">
                        </div>
                        <div class = "form-group">
                            <label>Last Name</label>
                            <input type = "text" name = "lname" class = "form-control">
                        </div>
                        <div class = "form-group">
                            <label>Skills</label>
                            <input type = "text" name = "skills" class = "form-control">
                        </div>
                        <div class = "form-group">
                            <label>Task(s)</label>
                            <input type = "text" name = "task" class = "form-control">
                        </div>
                        <div class = "form-group">
                            <label>Percentage of Task Completed (%)</label>
                            <input type = "text" name = "progress_percentage" class = "form-control">
                        </div>
                        <div class = "form-group">
                            <label>Meetings Attended</label>
                            <input type = "text" name = "meetings_attended" class = "form-control">
                        </div>
                        <div class = "form-group">
                            <label>Suggestions</label>
                            <input type = "text" name = "suggestions" class = "form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" name = "add_member" value = "Save Changes">
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>