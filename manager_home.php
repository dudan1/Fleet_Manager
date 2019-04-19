<?php
require 'templates/credentials/manager_creds.php';
require 'PHP_Scripts/db_connect.php';

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$sql = "SELECT first_name, surname, phone_number FROM managers WHERE email = '$_SESSION[name]'";
$result =mysqli_query($connection,$sql) or die(mysqli_error($connection));
$row = mysqli_fetch_array($result);
$firstname =$row['first_name'];
$surname =$row['surname'];
$phone_number =$row['phone_number'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manager Home</title>
    <link rel="stylesheet" type="text/css" href="CSS/styles.css">
    <link rel="stylesheet" type="text/css" href="CSS/unsemantic-grid-responsive-tablet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="js/scripts.js"></script>
</head>
<body>
<header>
    <?php require 'templates/nav_bar/manager_nav_bar.php';?>
</header>
<main>
        <div class="grid-container">
            <div class="grid-100">
                <div id="details" class="details_form" style="margin-top:100px">
                        <h1>Your details</h1>
                        <p>Please inform an administrator if the following details are incorrect.</p>
                        <p>Your first name: <?php echo $firstname ?></p>
                        <p>Your surname: <?php echo $surname ?></p>
                        <p>Phone number : <?php echo $phone_number ?></p>

                </div>
            </div>
        </div>
</main>
<footer>
    Duncan Orr 1809591 CMM007 <a href="about.html">About Fleet Manager</a>
</footer>
</body>
</html>