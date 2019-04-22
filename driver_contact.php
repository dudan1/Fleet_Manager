<?php
require 'templates/credentials/driver_creds.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us</title>
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
        <div class = grid-100>
            <h3>Feel free to contact support by any of these means.</h3>
            <h2>Managers</h2>
    <?php
    require 'PHP_Scripts/db_connect.php';
    $sql = "SELECT email, phone_number, first_name, surname FROM managers";
    $result = mysqli_query($connection, $sql);
    while ($row =mysqli_fetch_array($result)){
        echo "<h3>". $row['first_name']." ". $row['surname'] ."</h3><br>";
        echo"Phone Number: ". $row['phone_number'] ."<br> Email: ". $row['email']."<br>";

    }
?>
            <h2>Administrators</h2>
            <?php
            require 'PHP_Scripts/db_connect.php';
            $sql = "SELECT email, phone_number, first_name, surname FROM administrators";
            $result = mysqli_query($connection, $sql);
            while ($row =mysqli_fetch_array($result)){
                echo "<h3>". $row['first_name']." ". $row['surname'] ."</h3><br>";
                echo"Phone Number: ". $row['phone_number'] ."<br> ". "Email: ". $row['email']."<br>";

            }
            ?>
    </div>
    </div>
</main>
<footer>
    Duncan Orr 1809591 CMM007 <a href="about.php">About Fleet Manager</a>
</footer>
</body>
</html>