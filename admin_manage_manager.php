<?php
require 'templates/credentials/admin_only.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Manager Details</title>
    <link rel="stylesheet" type="text/css" href="CSS/styles.css">
    <link rel="stylesheet" type="text/css" href="CSS/unsemantic-grid-responsive-tablet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="js/scripts.js"></script>
</head>
<body>
<header>
    <?php require 'templates/nav_bar/admin_nav_bar.php';?>
</header>
<main>
    <div class="grid-container">
        <div class="grid-50">
            <div id="details" class="details_form" style="margin-top:100px">
                <form  action="PHP_Scripts/admin_add_manager.php" method="post">
                    <h1>Add New Manager Details</h1>
                    <p>Add new manager details below. Ensure all details are correct</p>
                    <p>Email address: <select name="email">
                            <?php
                            require_once ('PHP_Scripts/db_connect.php');
                            $sql = "SELECT email FROM users WHERE user_type = 'manager'";
                            $result=mysqli_query($connection,$sql) or die(mysqli_error($connection));
                            while($row =mysqli_fetch_array($result)){
                                echo "<option value='{$row['email']}'>{$row['email']}</option>";
                            }
                            ?>
                        </select></p>
                    <p>First Name: <input type="text" name="first_name" maxlength="15"></p>
                    <p>Surname: <input type="text" name="surname" maxlength="20"></p>
                    <p>Phone Number: <input type="text" name="phone_number" maxlength="15"></p>
                    <button type="submit">Add New Manager</button>
                </form>
            </div>
        </div>
        <div class="grid-50">
            <div id="details" class="details_form" style="margin-top:100px">
                <form  action="admin_manage_manager_update.php" method="post" enctype="multipart/form-data">
                    <h1>Update Manager Details</h1>
                    <p>Update selected manager's details.</p>
                    <p>Email address: <select name="email">
                            <?php
                            require_once ('PHP_Scripts/db_connect.php');
                            $sql = "SELECT email FROM managers";
                            $result=mysqli_query($connection,$sql) or die(mysqli_error($connection));
                            while($row =mysqli_fetch_array($result)){
                                echo "<option value='{$row['email']}'>{$row['email']}</option>";
                            }
                            ?>
                        </select></p>
                    <button type="submit">Edit Manager</button>
                </form>
                <form  action="PHP_Scripts/admin_delete_manager.php" method="post">
                    <h1>Clear Manager's Details</h1>
                    <p>Select a manager's details to delete.</p>
                    <p>Email address: <select name="email">
                            <?php
                            require_once ('PHP_Scripts/db_connect.php');
                            $sql = "SELECT email FROM managers";
                            $result=mysqli_query($connection,$sql) or die(mysqli_error($connection));
                            while($row =mysqli_fetch_array($result)){
                                echo "<option value='{$row['email']}'>{$row['email']}</option>";
                            }
                            ?>
                        </select></p>
                    <button type="submit">Clear Manager Details</button>
                </form>
            </div>
        </div>
    </div>
</main>
<footer>
    Duncan Orr 1809591 CMM007 <a href="about.php">About Fleet Manager</a>
</footer>
</body>
</html>