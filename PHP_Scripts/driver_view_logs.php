<?php
session_start();
$period=$_GET['period'];
if($period == "all_days") {
    require 'db_connect.php';
    $sql = "SELECT log_date, daily_takings, daily_mileage, no_journeys, fuel_cost  
 FROM logs WHERE driver_ID = '$_SESSION[driver_ID]' AND TIMESTAMP(log_date) < now()";
    $result = mysqli_query($connection, $sql);
 $num_rows= mysqli_num_rows($result);
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

    $sql = "SELECT  ROUND(AVG(daily_takings),2), ROUND(AVG(daily_mileage),2), ROUND(AVG(no_journeys),0), ROUND(AVG(fuel_cost),2)
 FROM logs WHERE driver_ID = '$_SESSION[driver_ID]' AND TIMESTAMP(log_date) < now()";
    $result = mysqli_query($connection, $sql);
    $num_rows= mysqli_num_rows($result);

    echo "<h3>Averages</h3>

<table>
<tr>
<th>Takings</th>
<th>Mileage</th>
<th>Number of Journeys</th>
<th>Fuel Cost</th>
</tr>";
    $row = mysqli_fetch_array($result);

        echo "<tr>";
        echo "<td>£" . $row['ROUND(AVG(daily_takings),2)'] . "</td>";
        echo "<td>" . $row['ROUND(AVG(daily_mileage),2)'] . "</td>";
        echo "<td>" . $row['ROUND(AVG(no_journeys),0)'] . "</td>";
        echo "<td>£" . $row['ROUND(AVG(fuel_cost),2)'] . "</td>";
        echo "</tr>";
    echo "</table>";

    $sql = "SELECT  ROUND(SUM(daily_takings),2), ROUND(SUM(daily_mileage),2), ROUND(SUM(no_journeys),0), ROUND(SUM(fuel_cost),2)
 FROM logs WHERE driver_ID = '$_SESSION[driver_ID]' AND TIMESTAMP(log_date) < now()";
    $result = mysqli_query($connection, $sql);
    $num_rows= mysqli_num_rows($result);

    echo "<h3>Totals</h3>

<table>
<tr>
<th>Takings</th>
<th>Mileage</th>
<th>Number of Journeys</th>
<th>Fuel Cost</th>
</tr>";
    $row = mysqli_fetch_array($result);

    echo "<tr>";
    echo "<td>£" . $row['ROUND(SUM(daily_takings),2)'] . "</td>";
    echo "<td>" . $row['ROUND(SUM(daily_mileage),2)'] . "</td>";
    echo "<td>" . $row['ROUND(SUM(no_journeys),0)'] . "</td>";
    echo "<td>£" . $row['ROUND(SUM(fuel_cost),2)'] . "</td>";
    echo "</tr>";
    echo "</table>";
    mysqli_close($connection);
}
elseif ($period =="7_days"){
    require 'db_connect.php';
    $sql = "SELECT log_date, daily_takings, daily_mileage, no_journeys, fuel_cost  
 FROM logs WHERE driver_ID = '$_SESSION[driver_ID]' AND TIMESTAMP(log_date) < now() AND TIMESTAMP(log_date) > (now()+ INTERVAL -7 DAY)";
    $result = mysqli_query($connection, $sql);
    $num_rows= mysqli_num_rows($result);
    // AVG(daily_takings), AVG(daily_takings), AVG(no_journeys), AVG(fuel_cost)

    echo "
<h3>Logs for Last Week</h3><table>
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

    $sql = "SELECT  ROUND(AVG(daily_takings),2), ROUND(AVG(daily_mileage),2), ROUND(AVG(no_journeys),0), ROUND(AVG(fuel_cost),2)
 FROM logs WHERE driver_ID = '$_SESSION[driver_ID]' AND TIMESTAMP(log_date) < now() AND TIMESTAMP(log_date) > (now()+INTERVAL -7 DAY)";
    $result = mysqli_query($connection, $sql);
    $num_rows= mysqli_num_rows($result);

    echo "<h3>Averages</h3>

<table>
<tr>
<th>Takings</th>
<th>Mileage</th>
<th>Number of Journeys</th>
<th>Fuel Cost</th>
</tr>";
    $row = mysqli_fetch_array($result);

    echo "<tr>";
    echo "<td>£" . $row['ROUND(AVG(daily_takings),2)'] . "</td>";
    echo "<td>" . $row['ROUND(AVG(daily_mileage),2)'] . "</td>";
    echo "<td>" . $row['ROUND(AVG(no_journeys),0)'] . "</td>";
    echo "<td>£" . $row['ROUND(AVG(fuel_cost),2)'] . "</td>";
    echo "</tr>";
    echo "</table>";

    $sql = "SELECT  ROUND(SUM(daily_takings),2), ROUND(SUM(daily_mileage),2), ROUND(SUM(no_journeys),0), ROUND(SUM(fuel_cost),2)
 FROM logs WHERE driver_ID = '$_SESSION[driver_ID]' AND TIMESTAMP(log_date) < now() AND TIMESTAMP(log_date) > (now()+INTERVAL -7 DAY)";
    $result = mysqli_query($connection, $sql);
    $num_rows= mysqli_num_rows($result);

    echo "<h3>Totals</h3>

<table>
<tr>
<th>Takings</th>
<th>Mileage</th>
<th>Number of Journeys</th>
<th>Fuel Cost</th>
</tr>";
    $row = mysqli_fetch_array($result);

    echo "<tr>";
    echo "<td>£" . $row['ROUND(SUM(daily_takings),2)'] . "</td>";
    echo "<td>" . $row['ROUND(SUM(daily_mileage),2)'] . "</td>";
    echo "<td>" . $row['ROUND(SUM(no_journeys),0)'] . "</td>";
    echo "<td>£" . $row['ROUND(SUM(fuel_cost),2)'] . "</td>";
    echo "</tr>";
    echo "</table>";
    mysqli_close($connection);
}
elseif ($period =="30_days"){
    require 'db_connect.php';
    $sql = "SELECT log_date, daily_takings, daily_mileage, no_journeys, fuel_cost  
 FROM logs WHERE driver_ID = '$_SESSION[driver_ID]' AND TIMESTAMP(log_date) < now() AND TIMESTAMP(log_date) > (now()+ INTERVAL -30 DAY)";
    $result = mysqli_query($connection, $sql);
    $num_rows= mysqli_num_rows($result);
    // AVG(daily_takings), AVG(daily_takings), AVG(no_journeys), AVG(fuel_cost)

    echo "
<h3>Logs for Last 30 Days</h3><table>
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

    $sql = "SELECT  ROUND(AVG(daily_takings),2), ROUND(AVG(daily_mileage),2), ROUND(AVG(no_journeys),0), ROUND(AVG(fuel_cost),2)
 FROM logs WHERE driver_ID = '$_SESSION[driver_ID]' AND TIMESTAMP(log_date) < now() AND TIMESTAMP(log_date) > (now()+INTERVAL -30 DAY)";
    $result = mysqli_query($connection, $sql);
    $num_rows= mysqli_num_rows($result);

    echo "<h3>Averages</h3>

<table>
<tr>
<th>Takings</th>
<th>Mileage</th>
<th>Number of Journeys</th>
<th>Fuel Cost</th>
</tr>";
    $row = mysqli_fetch_array($result);

    echo "<tr>";
    echo "<td>£" . $row['ROUND(AVG(daily_takings),2)'] . "</td>";
    echo "<td>" . $row['ROUND(AVG(daily_mileage),2)'] . "</td>";
    echo "<td>" . $row['ROUND(AVG(no_journeys),0)'] . "</td>";
    echo "<td>£" . $row['ROUND(AVG(fuel_cost),2)'] . "</td>";
    echo "</tr>";
    echo "</table>";

    $sql = "SELECT  ROUND(SUM(daily_takings),2), ROUND(SUM(daily_mileage),2), ROUND(SUM(no_journeys),0), ROUND(SUM(fuel_cost),2)
 FROM logs WHERE driver_ID = '$_SESSION[driver_ID]' AND TIMESTAMP(log_date) < now() AND TIMESTAMP(log_date) > (now()+INTERVAL -30 DAY)";
    $result = mysqli_query($connection, $sql);
    $num_rows= mysqli_num_rows($result);

    echo "<h3>Totals</h3>

<table>
<tr>
<th>Takings</th>
<th>Mileage</th>
<th>Number of Journeys</th>
<th>Fuel Cost</th>
</tr>";
    $row = mysqli_fetch_array($result);

    echo "<tr>";
    echo "<td>£" . $row['ROUND(SUM(daily_takings),2)'] . "</td>";
    echo "<td>" . $row['ROUND(SUM(daily_mileage),2)'] . "</td>";
    echo "<td>" . $row['ROUND(SUM(no_journeys),0)'] . "</td>";
    echo "<td>£" . $row['ROUND(SUM(fuel_cost),2)'] . "</td>";
    echo "</tr>";
    echo "</table>";
    mysqli_close($connection);
}
elseif ($period =="365_days"){
    require 'db_connect.php';
    $sql = "SELECT log_date, daily_takings, daily_mileage, no_journeys, fuel_cost  
 FROM logs WHERE driver_ID = '$_SESSION[driver_ID]' AND TIMESTAMP(log_date) < now() AND TIMESTAMP(log_date) > (now()+ INTERVAL -365 DAY)";
    $result = mysqli_query($connection, $sql);
    $num_rows= mysqli_num_rows($result);
    // AVG(daily_takings), AVG(daily_takings), AVG(no_journeys), AVG(fuel_cost)

    echo "
<h3>Logs for Last Year</h3><table>
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

    $sql = "SELECT  ROUND(AVG(daily_takings),2), ROUND(AVG(daily_mileage),2), ROUND(AVG(no_journeys),0), ROUND(AVG(fuel_cost),2)
 FROM logs WHERE driver_ID = '$_SESSION[driver_ID]' AND TIMESTAMP(log_date) < now() AND TIMESTAMP(log_date) > (now()+INTERVAL -365 DAY)";
    $result = mysqli_query($connection, $sql);
    $num_rows= mysqli_num_rows($result);

    echo "<h3>Averages</h3>

<table>
<tr>
<th>Takings</th>
<th>Mileage</th>
<th>Number of Journeys</th>
<th>Fuel Cost</th>
</tr>";
    $row = mysqli_fetch_array($result);

    echo "<tr>";
    echo "<td>£" . $row['ROUND(AVG(daily_takings),2)'] . "</td>";
    echo "<td>" . $row['ROUND(AVG(daily_mileage),2)'] . "</td>";
    echo "<td>" . $row['ROUND(AVG(no_journeys),0)'] . "</td>";
    echo "<td>£" . $row['ROUND(AVG(fuel_cost),2)'] . "</td>";
    echo "</tr>";
    echo "</table>";

    $sql = "SELECT  ROUND(SUM(daily_takings),2), ROUND(SUM(daily_mileage),2), ROUND(SUM(no_journeys),0), ROUND(SUM(fuel_cost),2)
 FROM logs WHERE driver_ID = '$_SESSION[driver_ID]' AND TIMESTAMP(log_date) < now() AND TIMESTAMP(log_date) > (now()+INTERVAL -365 DAY)";
    $result = mysqli_query($connection, $sql);
    $num_rows= mysqli_num_rows($result);

    echo "<h3>Totals</h3>

<table>
<tr>
<th>Takings</th>
<th>Mileage</th>
<th>Number of Journeys</th>
<th>Fuel Cost</th>
</tr>";
    $row = mysqli_fetch_array($result);

    echo "<tr>";
    echo "<td>£" . $row['ROUND(SUM(daily_takings),2)'] . "</td>";
    echo "<td>" . $row['ROUND(SUM(daily_mileage),2)'] . "</td>";
    echo "<td>" . $row['ROUND(SUM(no_journeys),0)'] . "</td>";
    echo "<td>£" . $row['ROUND(SUM(fuel_cost),2)'] . "</td>";
    echo "</tr>";
    echo "</table>";
    mysqli_close($connection);
}