<?php
require 'templates/credentials/driver_creds.php';
require "PHP_Scripts/db_connect.php";
$email = $_SESSION['name'];
$sql= "Select * From drivers where email = '$email'";
$result = mysqli_query($connection, $sql);
$row=mysqli_fetch_array($result);
$first_name = $row['first_name'];
$surname = $row['surname'];
$vehicle_reg = $row['vehicle_reg'];
$licence_number = $row['licence_number'];
$licence_url = $row['licence_url'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View My Profile</title>
    <link rel="stylesheet" type="text/css" href="CSS/styles.css">
    <link rel="stylesheet" type="text/css" href="CSS/unsemantic-grid-responsive-tablet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="js/scripts.js"></script>
</head>
<body>
<header>
    <?php require 'templates/nav_bar/driver_nav_bar.php';?>
</header>
<main>
    <div class="grid-container">
        <div class="grid-100">
            <div id="details_table" class="details_table" style="margin-top:100px">
                <h2>My Details</h2>
                <table>
                    <tr>Email address: <?php echo "{$email}"?><br></tr>
                    <tr>First Name: <?php echo "{$first_name}"?><br></tr>
                    <tr>Surname: <?php echo "{$surname}"?><br></tr>
                    <tr>Vehicle Registration Number: <?php echo "{$vehicle_reg}"?><br></tr>
                    <tr>Licence Number: <?php echo "{$licence_number}"?><br></tr>
                </table>
                Current Driver's License <a target ='_blank' href ='<?php echo "{$licence_url}"?>'><img src='<?php echo "{$licence_url}"?>' alt="drivers licence" height = 200px></a>
                <p>Please inform an administrator if any of these details are incorrect</p>
            </div>
        </div>
    </div>
</main>
<footer>
    Duncan Orr 1809591 CMM007 <a href="about.php">About Fleet Manager</a>
</footer>
</body>
</html>