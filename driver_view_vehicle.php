<?php
require 'templates/credentials/driver_creds.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View My Vehicle</title>
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
        <h2>My Vehicle</h2>
    <?php
    require 'PHP_Scripts/db_connect.php';
    $sql = "SELECT * FROM vehicles WHERE driver_ID = '$_SESSION[driver_ID]'";
    $result = mysqli_query($connection, $sql);
    $num_rows= mysqli_num_rows($result);

    while ($row = $result->fetch_assoc()) {
        echo "<div class = 'vehicle_table'>";
        echo "<h3>".$row["vehicle_reg"]."</h3>";
        echo "<table>";
        echo "<tr><td>Vehicle Registration: </td><td>" . $row["vehicle_reg"] . "</td></tr>";
        echo "<tr><td>Make: </td><td>" . $row["make"] . "</td></tr>";
        echo "<tr><td>Model: </td><td>" . $row["model"] . "</td></tr>";
        echo "<tr><td>Date of last MOT: </td><td>" . $row["date_prev_MOT"] . "</td></tr>";
        echo "<tr><td>Date of next MOT: </td><td>" . $row["date_next_MOT"] . "</td></tr>";
        echo "<tr><td>Date Car Tax Due: </td><td>" . $row["car_tax_due_date"] . "</td></tr>";
        echo "<tr><td>Name of Car Insurer: </td><td>" . $row["insurer_name"] . "</td></tr>";
        echo "<tr><td>Insurance Policy Number: </td><td>" . $row["insurance_policy_no"] . "</td></tr>";
        echo "<tr><td>Insurance Renewal Date: </td><td>" . $row["insurance_renewal_date"] . "</td></tr>";
        echo "<tr><td>Date of last Service: </td><td>" . $row["last_service"] . "</td></tr>";
        echo "</table>";
        echo "</div>";
    }

    ?>
</div></div>
</main>
<footer>
    Duncan Orr 1809591 CMM007 <a href="about.html">About Fleet Manager</a>
</footer>
</body>
</html>