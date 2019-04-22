<?php
require 'db_connect.php';
$vehicle = mysqli_real_escape_string($connection, $_GET['vehicle']);

$sql = "SELECT * FROM vehicles WHERE vehicle_reg = '$vehicle'";
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