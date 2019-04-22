<?php
require 'templates/credentials/admin_only.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Driver Details</title>
    <link rel="stylesheet" type="text/css" href="CSS/styles.css">
    <link rel="stylesheet" type="text/css" href="CSS/unsemantic-grid-responsive-tablet.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="js/scripts.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('input[type="file"]').change(function(e){
                var fileName = e.target.files[0].name;
                document.getElementById('filename').value = fileName
            });
        });
    </script>
</head>
<body>
<header>
    <?php require 'templates/nav_bar/admin_nav_bar.php';?>
</header>
<main>
<div class="grid-container">
    <div class="grid-50">
        <div id="details" class="details_form" style="margin-top:100px">
            <form  action="PHP_Scripts/admin_add_driver.php" method="post" enctype="multipart/form-data">
                <h1>Add New Driver Details</h1>
                <p>Add new driver details below. Ensure all details are correct</p>
                <p>Email address: <select name="email">
                        <?php
                        require_once ('PHP_Scripts/db_connect.php');
                        $sql = "SELECT email FROM users WHERE user_type = 'driver'";
                        $result=mysqli_query($connection,$sql) or die(mysqli_error($connection));
                        while($row =mysqli_fetch_array($result)){
                            echo "<option value='{$row['email']}'>{$row['email']}</option>";
                        }
                        ?>
                    </select></p>
                <p>First Name: <input type="text" name="first_name" maxlength="15"></p>
                <p>Surname: <input type="text" name="surname" maxlength="20"></p>
                <p>Vehicle Registration Number:<input type="text" name="registration" maxlength="7"></p>
                <p>Licence Number: <input type="text" name="licence" maxlength="16"></p>
                <p>Licence Points: <input type="text" name="points" maxlength="2"></p>
                <p>Scan of License to upload:
                <input type="file" name="fileToUpload" id="fileToUpload" required>
                    <input type="hidden" name="filename" id="filename"></p>
                <button type="submit">Add New Driver</button>
            </form>
        </div>
    </div>
    <div class="grid-50">
        <div id="details" class="details_form" style="margin-top:100px">
            <form  action="admin_manage_driver_update.php" method="post" enctype="multipart/form-data">
                <h1>Update Driver Details</h1>
                <p>Update selected driver details.</p>
                <p>Email address: <select name="email">
                        <?php
                        require_once ('PHP_Scripts/db_connect.php');
                        $sql = "SELECT email FROM drivers";
                        $result=mysqli_query($connection,$sql) or die(mysqli_error($connection));
                        while($row =mysqli_fetch_array($result)){
                            echo "<option value='{$row['email']}'>{$row['email']}</option>";
                        }
                        ?>
                    </select></p>
                <button type="submit">Edit Driver</button>
            </form>
            <form  action="PHP_Scripts/admin_delete_driver.php" method="post">
                <h1>Clear Driver's Details</h1>
                <p>Select a driver's details to delete.</p>
                <p>Email address: <select name="email">
                        <?php
                        require_once ('PHP_Scripts/db_connect.php');
                        $sql = "SELECT email FROM drivers";
                        $result=mysqli_query($connection,$sql) or die(mysqli_error($connection));
                        while($row =mysqli_fetch_array($result)){
                            echo "<option value='{$row['email']}'>{$row['email']}</option>";
                        }
                        ?>
                    </select></p>
                <button type="submit">Clear Driver Details</button>
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