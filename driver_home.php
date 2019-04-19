<?php
require 'templates/credentials/driver_creds.php';
require 'PHP_Scripts/db_connect.php';
$sql = "SELECT driver_ID FROM drivers WHERE email = '$_SESSION[name]'";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_array($result);
$_SESSION['driver_ID'] = $row['driver_ID'];
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
        <div class="grid-100">
            <div id="log" class="log_form_container" style="margin-top:100px">
                <form class="log_form" action="PHP_Scripts/driver_home_submit.php" method="post">
                    <h1>Enter Your Daily Log</h1>
                    <p>Enter your daily log in here.</p>
                    <p>Today's Takings: <span class="currencyinput">£<input type="text" name="daily_takings" maxlength="10"></span></p>
                    <p>Today's Miles Travelled: <input type="text" name="daily_mileage" maxlength="10"></p>
                    <p>Number of Journeys: <input type="text" name="no_journeys" maxlength="10"></p>
                    <p>Cost of Fuel Purchased: <span class="currencyinput">£<input type="text" name="fuel_cost" maxlength="10"></span></p>
                    <button type="submit">Post Daily Log</button>
                </form>
            </div>
            <div class="notifications">
                <h3>Notifications</h3>
                <?php
                $sql = "SELECT * FROM vehicles WHERE driver_ID = '$_SESSION[driver_ID]'";
                $result = mysqli_query($connection, $sql);
                $num_rows= mysqli_num_rows($result);
                while($row = mysqli_fetch_array($result)) {
                    $next_mot = $row['date_next_MOT'];
                    $tax = $row['car_tax_due_date'];
                    $insurance = $row['insurance_renewal_date'];
                    $car = $row['vehicle_reg'];
                    $date = date("Y/m/d");
                    echo "Today's Date " . $date."<br>";
                    echo "Vehicle Registration " . $car."<br>";
                    echo "Car Tax Due Date: " . $tax."<br>";
                    echo "Next MOT Date: " . $next_mot."<br>";
                    echo "Insurance Renewal Date: " . $insurance."<br>";
                }
                ?>

            </div>
        </div>
    </div>
</main>
<footer>
    Duncan Orr 1809591 CMM007 <a href="about.html">About Fleet Manager</a>
</footer>
</body>
</html>