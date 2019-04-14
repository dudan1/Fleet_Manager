<?php
require 'templates/credentials/driver_creds.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Driver Home</title>
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
        <div class="grid-33"></div>
        <div class="grid-33">
            <div id="log" class="log_form" style="margin-top:100px">
                <form  action="PHP_Scripts/admin_edit_vehicle.php" method="post">
                    <h1>Enter Your Daily Log</h1>
                    <p>Enter your daily log in here.</p>
                    <p>Today's Takings: <input type="text" name="daily_takings" maxlength="10"></p>
                    <p>Today's Miles Travelled: <input type="text" name="daily_mileage" maxlength="10"></p>
                    <p>Number of Journeys: <input type="text" name="no_journeys" maxlength="10"></p>
                    <p>Cost of Fuel Purchased: <input type="text" name="fuel_cost" maxlength="10"></p>
                    <button type="submit">Post Daily Log</button>
                </form>
            </div>
        </div>
        <div class="grid-33"></div>
    </div>
</main>
<footer>
    Duncan Orr 1809591 CMM007 <a href="about.html">About Fleet Manager</a>
</footer>
</body>
</html>