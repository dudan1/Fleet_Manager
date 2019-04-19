<?php
session_start();
$period=$_GET['period'];
$id=$_GET['id'];
//if($period == "all_days") {
    require 'db_connect.php';
    $sql = "SELECT log_date, daily_takings, daily_mileage, no_journeys, fuel_cost  
 FROM logs WHERE driver_ID = $id AND TIMESTAMP(log_date) < now()";
    $result = mysqli_query($connection, $sql);
    $num_rows = mysqli_num_rows($result);
    // AVG(daily_takings), AVG(daily_takings), AVG(no_journeys), AVG(fuel_cost)

    echo "
<h3>Full Logs</h3><table>
<tr>
<th>Log Date</th>
<th>Takings</th>
<th>Mileage</th>
<th>Number of Journeys</th>
<th>Fuel Cost</th>
</tr>";


    while ($row = $result->fetch_assoc()) {


        $field1name = $row["log_date"];
        $field2name = $row["daily_takings"];
        $field3name = $row["daily_mileage"];
        $field4name = $row["no_journeys"];
        $field5name = $row["fuel_cost"];
        echo "<tr>";
        echo "<td>" . $field1name . "</td>";
        echo "<td>£" . $field2name . "</td>";
        echo "<td>" . $field3name . "</td>";
        echo "<td>" . $field4name . "</td>";
        echo "<td>£" . $field5name . "</td>";
        echo "</tr>";
    }
    echo "</table>";
//}
?>