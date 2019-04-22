<?php
require 'templates/credentials/manager_creds.php';
$period="";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Data</title>
    <link rel="stylesheet" type="text/css" href="CSS/styles.css">
    <link rel="stylesheet" type="text/css" href="CSS/unsemantic-grid-responsive-tablet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="js/scripts.js"></script>
    <script type="text/javascript">
        function getLogs(str,id) {
            if (str == "") {
                document.getElementById("logTable").innerHTML = "";
                return;
            } else {
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {
                    // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("logTable").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET","PHP_Scripts/manager_search_function.php?period="+str+"&id="+id,true);
                xmlhttp.send();
            }
        }

    </script>
</head>
<body>
<header>
    <?php require 'templates/nav_bar/manager_nav_bar.php';?>
</header>
<main>
    <div class="grid-container">
        <div class="grid-100">
    <div class="log_form_container" style="padding-top: 200px">
        <form>
            <h3>Select which logs you want to display</h3>
            Driver: <select id="driver" name="driver">
                <option value =""></option>
                <option value ="all">All Drivers</option>
<?php
require_once ('PHP_Scripts/db_connect.php');
$sql = "SELECT driver_ID, first_name, surname FROM drivers";
$result=mysqli_query($connection,$sql) or die(mysqli_error($connection));
while($row =mysqli_fetch_array($result)){
    echo "<option value='{$row['driver_ID']}'>{$row['first_name']} {$row['surname']}</option>";
}
?>
            </select>
            Time Period: <select id="period" name="period">
                <option value =""></option>
                <option value ="7_days">Last Week</option>
                <option value ="30_days">Last Month</option>
                <option value ="365_days">Last Year</option>
                <option value ="all_days">Total</option>
            </select>
            <button onclick="getLogs(period.value,driver.value)">Search</button>
        </form>
    </div>
    <div id="logTable"></div>
    <?php
    $period=$_GET['period'];
    $id=$_GET['driver'];
    if(is_numeric($id)) {
        if ($period == "all_days") {

            require 'PHP_Scripts/db_connect.php';
            $sql = "SELECT l.log_date, l.daily_takings, l.daily_mileage, l.no_journeys, l.fuel_cost, d.first_name, d.surname 
    FROM logs l, drivers d WHERE l.driver_ID = '$id' AND TIMESTAMP(l.log_date) < now() AND d.driver_ID = l.driver_ID";
            $result = mysqli_query($connection, $sql);

            $num_rows = mysqli_num_rows($result);
            echo "
    <h3>Full Logs</h3><table>
        <tr>
            <th>Driver Name</th>
            <th>Log Date</th>
            <th>Takings</th>
            <th>Mileage</th>
            <th>Number of Journeys</th>
            <th>Fuel Cost</th>
        </tr>";


            while ($row = $result->fetch_assoc()) {

                $field0name = $row['first_name'] . " " . $row['surname'];
                $field1name = $row["log_date"];
                $field2name = $row["daily_takings"];
                $field3name = $row["daily_mileage"];
                $field4name = $row["no_journeys"];
                $field5name = $row["fuel_cost"];
                echo "<tr>";
                echo "<td>" . $field0name . "</td>";
                echo "<td>" . $field1name . "</td>";
                echo "<td>£" . $field2name . "</td>";
                echo "<td>" . $field3name . "</td>";
                echo "<td>" . $field4name . "</td>";
                echo "<td>£" . $field5name . "</td>";
                echo "</tr>";
            }
            echo "</table>";

            $sql = "SELECT  ROUND(AVG(l.daily_takings),2), ROUND(AVG(l.daily_mileage),2), ROUND(AVG(l.no_journeys),0), ROUND(AVG(l.fuel_cost),2),
 ROUND(SUM(l.daily_takings),2), ROUND(SUM(l.daily_mileage),2), ROUND(SUM(l.no_journeys),0), ROUND(SUM(l.fuel_cost),2), d.first_name, d.surname
 FROM logs l, drivers d WHERE l.driver_ID = '$id' AND TIMESTAMP(l.log_date) < now() AND d.driver_ID = l.driver_ID";
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
            echo "<td>£" . $row['ROUND(AVG(l.daily_takings),2)'] . "</td>";
            echo "<td>" . $row['ROUND(AVG(l.daily_mileage),2)'] . "</td>";
            echo "<td>" . $row['ROUND(AVG(l.no_journeys),0)'] . "</td>";
            echo "<td>£" . $row['ROUND(AVG(l.fuel_cost),2)'] . "</td>";
            echo "</tr>";
            echo "</table>";

            echo "<h3>Totals</h3>

<table>
<tr>
<th>Takings</th>
<th>Mileage</th>
<th>Number of Journeys</th>
<th>Fuel Cost</th>
</tr>";
            echo "<tr>";
            echo "<td>£" . $row['ROUND(SUM(l.daily_takings),2)'] . "</td>";
            echo "<td>" . $row['ROUND(SUM(l.daily_mileage),2)'] . "</td>";
            echo "<td>" . $row['ROUND(SUM(l.no_journeys),0)'] . "</td>";
            echo "<td>£" . $row['ROUND(SUM(l.fuel_cost),2)'] . "</td>";
            echo "</tr>";
            echo "</table>";
        }
        elseif ($period == "7_days"){
            require 'PHP_Scripts/db_connect.php';
            $sql = "SELECT l.log_date, l.daily_takings, l.daily_mileage, l.no_journeys, l.fuel_cost, d.first_name, d.surname 
    FROM logs l, drivers d WHERE l.driver_ID = '$id' AND TIMESTAMP(l.log_date) < now() AND d.driver_ID = l.driver_ID 
    AND TIMESTAMP(l.log_date) > (now()+ INTERVAL -7 DAY)";
            $result = mysqli_query($connection, $sql);

            $num_rows = mysqli_num_rows($result);
            echo "
    <h3>Full Logs</h3><table>
        <tr>
            <th>Driver Name</th>
            <th>Log Date</th>
            <th>Takings</th>
            <th>Mileage</th>
            <th>Number of Journeys</th>
            <th>Fuel Cost</th>
        </tr>";


            while ($row = $result->fetch_assoc()) {

                $field0name = $row['first_name'] . " " . $row['surname'];
                $field1name = $row["log_date"];
                $field2name = $row["daily_takings"];
                $field3name = $row["daily_mileage"];
                $field4name = $row["no_journeys"];
                $field5name = $row["fuel_cost"];
                echo "<tr>";
                echo "<td>" . $field0name . "</td>";
                echo "<td>" . $field1name . "</td>";
                echo "<td>£" . $field2name . "</td>";
                echo "<td>" . $field3name . "</td>";
                echo "<td>" . $field4name . "</td>";
                echo "<td>£" . $field5name . "</td>";
                echo "</tr>";
            }
            echo "</table>";

            $sql = "SELECT  ROUND(AVG(l.daily_takings),2), ROUND(AVG(l.daily_mileage),2), ROUND(AVG(l.no_journeys),0), 
ROUND(AVG(l.fuel_cost),2),ROUND(SUM(l.daily_takings),2), ROUND(SUM(l.daily_mileage),2), ROUND(SUM(l.no_journeys),0),
 ROUND(SUM(l.fuel_cost),2), d.first_name, d.surname FROM logs l, drivers d WHERE l.driver_ID = '$id' AND 
 TIMESTAMP(l.log_date) < now() AND d.driver_ID = l.driver_ID AND TIMESTAMP(log_date) > (now()+ INTERVAL -7 DAY)";
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
            echo "<td>£" . $row['ROUND(AVG(l.daily_takings),2)'] . "</td>";
            echo "<td>" . $row['ROUND(AVG(l.daily_mileage),2)'] . "</td>";
            echo "<td>" . $row['ROUND(AVG(l.no_journeys),0)'] . "</td>";
            echo "<td>£" . $row['ROUND(AVG(l.fuel_cost),2)'] . "</td>";
            echo "</tr>";
            echo "</table>";

            echo "<h3>Totals</h3>

<table>
<tr>
<th>Takings</th>
<th>Mileage</th>
<th>Number of Journeys</th>
<th>Fuel Cost</th>
</tr>";
            echo "<tr>";
            echo "<td>£" . $row['ROUND(SUM(l.daily_takings),2)'] . "</td>";
            echo "<td>" . $row['ROUND(SUM(l.daily_mileage),2)'] . "</td>";
            echo "<td>" . $row['ROUND(SUM(l.no_journeys),0)'] . "</td>";
            echo "<td>£" . $row['ROUND(SUM(l.fuel_cost),2)'] . "</td>";
            echo "</tr>";
            echo "</table>";
        }
        elseif($period =="30_days"){
            require 'PHP_Scripts/db_connect.php';
            $sql = "SELECT l.log_date, l.daily_takings, l.daily_mileage, l.no_journeys, l.fuel_cost, d.first_name, d.surname 
    FROM logs l, drivers d WHERE l.driver_ID = '$id' AND TIMESTAMP(l.log_date) < now() AND d.driver_ID = l.driver_ID 
    AND TIMESTAMP(l.log_date) > (now()+ INTERVAL -30 DAY)";
            $result = mysqli_query($connection, $sql);

            $num_rows = mysqli_num_rows($result);
            echo "
    <h3>Full Logs</h3><table>
        <tr>
            <th>Driver Name</th>
            <th>Log Date</th>
            <th>Takings</th>
            <th>Mileage</th>
            <th>Number of Journeys</th>
            <th>Fuel Cost</th>
        </tr>";


            while ($row = $result->fetch_assoc()) {

                $field0name = $row['first_name'] . " " . $row['surname'];
                $field1name = $row["log_date"];
                $field2name = $row["daily_takings"];
                $field3name = $row["daily_mileage"];
                $field4name = $row["no_journeys"];
                $field5name = $row["fuel_cost"];
                echo "<tr>";
                echo "<td>" . $field0name . "</td>";
                echo "<td>" . $field1name . "</td>";
                echo "<td>£" . $field2name . "</td>";
                echo "<td>" . $field3name . "</td>";
                echo "<td>" . $field4name . "</td>";
                echo "<td>£" . $field5name . "</td>";
                echo "</tr>";
            }
            echo "</table>";

            $sql = "SELECT  ROUND(AVG(l.daily_takings),2), ROUND(AVG(l.daily_mileage),2), ROUND(AVG(l.no_journeys),0), 
ROUND(AVG(l.fuel_cost),2),ROUND(SUM(l.daily_takings),2), ROUND(SUM(l.daily_mileage),2), ROUND(SUM(l.no_journeys),0),
 ROUND(SUM(l.fuel_cost),2), d.first_name, d.surname FROM logs l, drivers d WHERE l.driver_ID = '$id' AND 
 TIMESTAMP(l.log_date) < now() AND d.driver_ID = l.driver_ID AND TIMESTAMP(l.log_date) > (now()+ INTERVAL -30 DAY)";
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
            echo "<td>£" . $row['ROUND(AVG(l.daily_takings),2)'] . "</td>";
            echo "<td>" . $row['ROUND(AVG(l.daily_mileage),2)'] . "</td>";
            echo "<td>" . $row['ROUND(AVG(l.no_journeys),0)'] . "</td>";
            echo "<td>£" . $row['ROUND(AVG(l.fuel_cost),2)'] . "</td>";
            echo "</tr>";
            echo "</table>";

            echo "<h3>Totals</h3>

<table>
<tr>
<th>Takings</th>
<th>Mileage</th>
<th>Number of Journeys</th>
<th>Fuel Cost</th>
</tr>";
            echo "<tr>";
            echo "<td>£" . $row['ROUND(SUM(l.daily_takings),2)'] . "</td>";
            echo "<td>" . $row['ROUND(SUM(l.daily_mileage),2)'] . "</td>";
            echo "<td>" . $row['ROUND(SUM(l.no_journeys),0)'] . "</td>";
            echo "<td>£" . $row['ROUND(SUM(l.fuel_cost),2)'] . "</td>";
            echo "</tr>";
            echo "</table>";
        }
        elseif ($period=="365_days"){
            require 'PHP_Scripts/db_connect.php';
            $sql = "SELECT l.log_date, l.daily_takings, l.daily_mileage, l.no_journeys, l.fuel_cost, d.first_name, d.surname 
    FROM logs l, drivers d WHERE l.driver_ID = '$id' AND TIMESTAMP(l.log_date) < now() AND d.driver_ID = l.driver_ID 
    AND TIMESTAMP(l.log_date) > (now()+ INTERVAL -365 DAY)";
            $result = mysqli_query($connection, $sql);

            $num_rows = mysqli_num_rows($result);
            echo "
    <h3>Full Logs</h3><table>
        <tr>
            <th>Driver Name</th>
            <th>Log Date</th>
            <th>Takings</th>
            <th>Mileage</th>
            <th>Number of Journeys</th>
            <th>Fuel Cost</th>
        </tr>";


            while ($row = $result->fetch_assoc()) {

                $field0name = $row['first_name'] . " " . $row['surname'];
                $field1name = $row["log_date"];
                $field2name = $row["daily_takings"];
                $field3name = $row["daily_mileage"];
                $field4name = $row["no_journeys"];
                $field5name = $row["fuel_cost"];
                echo "<tr>";
                echo "<td>" . $field0name . "</td>";
                echo "<td>" . $field1name . "</td>";
                echo "<td>£" . $field2name . "</td>";
                echo "<td>" . $field3name . "</td>";
                echo "<td>" . $field4name . "</td>";
                echo "<td>£" . $field5name . "</td>";
                echo "</tr>";
            }
            echo "</table>";

            $sql = "SELECT  ROUND(AVG(l.daily_takings),2), ROUND(AVG(l.daily_mileage),2), ROUND(AVG(l.no_journeys),0), 
ROUND(AVG(l.fuel_cost),2),ROUND(SUM(l.daily_takings),2), ROUND(SUM(l.daily_mileage),2), ROUND(SUM(l.no_journeys),0),
 ROUND(SUM(l.fuel_cost),2), d.first_name, d.surname FROM logs l, drivers d WHERE l.driver_ID = '$id' AND 
 TIMESTAMP(l.log_date) < now() AND d.driver_ID = l.driver_ID AND TIMESTAMP(l.log_date) > (now()+ INTERVAL -365 DAY)";
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
            echo "<td>£" . $row['ROUND(AVG(l.daily_takings),2)'] . "</td>";
            echo "<td>" . $row['ROUND(AVG(l.daily_mileage),2)'] . "</td>";
            echo "<td>" . $row['ROUND(AVG(l.no_journeys),0)'] . "</td>";
            echo "<td>£" . $row['ROUND(AVG(l.fuel_cost),2)'] . "</td>";
            echo "</tr>";
            echo "</table>";

            echo "<h3>Totals</h3>

<table>
<tr>
<th>Takings</th>
<th>Mileage</th>
<th>Number of Journeys</th>
<th>Fuel Cost</th>
</tr>";
            echo "<tr>";
            echo "<td>£" . $row['ROUND(SUM(l.daily_takings),2)'] . "</td>";
            echo "<td>" . $row['ROUND(SUM(l.daily_mileage),2)'] . "</td>";
            echo "<td>" . $row['ROUND(SUM(l.no_journeys),0)'] . "</td>";
            echo "<td>£" . $row['ROUND(SUM(l.fuel_cost),2)'] . "</td>";
            echo "</tr>";
            echo "</table>";
        }
    }
    else{
        if ($period == "all_days") {

            require 'PHP_Scripts/db_connect.php';
            $sql = "SELECT l.log_date, l.daily_takings, l.daily_mileage, l.no_journeys, l.fuel_cost, d.first_name, d.surname 
    FROM logs l, drivers d WHERE TIMESTAMP(l.log_date) < now() AND d.driver_ID = l.driver_ID";
            $result = mysqli_query($connection, $sql);

            $num_rows = mysqli_num_rows($result);
            echo "
    <h3>Full Logs</h3><table>
        <tr>
            <th>Driver Name</th>
            <th>Log Date</th>
            <th>Takings</th>
            <th>Mileage</th>
            <th>Number of Journeys</th>
            <th>Fuel Cost</th>
        </tr>";


            while ($row = $result->fetch_assoc()) {

                $field0name = $row['first_name'] . " " . $row['surname'];
                $field1name = $row["log_date"];
                $field2name = $row["daily_takings"];
                $field3name = $row["daily_mileage"];
                $field4name = $row["no_journeys"];
                $field5name = $row["fuel_cost"];
                echo "<tr>";
                echo "<td>" . $field0name . "</td>";
                echo "<td>" . $field1name . "</td>";
                echo "<td>£" . $field2name . "</td>";
                echo "<td>" . $field3name . "</td>";
                echo "<td>" . $field4name . "</td>";
                echo "<td>£" . $field5name . "</td>";
                echo "</tr>";
            }
            echo "</table>";

            $sql = "SELECT  ROUND(AVG(l.daily_takings),2), ROUND(AVG(l.daily_mileage),2), ROUND(AVG(l.no_journeys),0), ROUND(AVG(l.fuel_cost),2),
 ROUND(SUM(l.daily_takings),2), ROUND(SUM(l.daily_mileage),2), ROUND(SUM(l.no_journeys),0), ROUND(SUM(l.fuel_cost),2), d.first_name, d.surname
 FROM logs l, drivers d WHERE TIMESTAMP(l.log_date) < now() AND d.driver_ID = l.driver_ID";
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
            echo "<td>£" . $row['ROUND(AVG(l.daily_takings),2)'] . "</td>";
            echo "<td>" . $row['ROUND(AVG(l.daily_mileage),2)'] . "</td>";
            echo "<td>" . $row['ROUND(AVG(l.no_journeys),0)'] . "</td>";
            echo "<td>£" . $row['ROUND(AVG(l.fuel_cost),2)'] . "</td>";
            echo "</tr>";
            echo "</table>";

            echo "<h3>Totals</h3>

<table>
<tr>
<th>Takings</th>
<th>Mileage</th>
<th>Number of Journeys</th>
<th>Fuel Cost</th>
</tr>";
            echo "<tr>";
            echo "<td>£" . $row['ROUND(SUM(l.daily_takings),2)'] . "</td>";
            echo "<td>" . $row['ROUND(SUM(l.daily_mileage),2)'] . "</td>";
            echo "<td>" . $row['ROUND(SUM(l.no_journeys),0)'] . "</td>";
            echo "<td>£" . $row['ROUND(SUM(l.fuel_cost),2)'] . "</td>";
            echo "</tr>";
            echo "</table>";
        }
        elseif ($period == "7_days"){
            require 'PHP_Scripts/db_connect.php';
            $sql = "SELECT l.log_date, l.daily_takings, l.daily_mileage, l.no_journeys, l.fuel_cost, d.first_name, d.surname 
    FROM logs l, drivers d WHERE TIMESTAMP(l.log_date) < now() AND d.driver_ID = l.driver_ID 
    AND TIMESTAMP(l.log_date) > (now()+ INTERVAL -7 DAY)";
            $result = mysqli_query($connection, $sql);

            $num_rows = mysqli_num_rows($result);
            echo "
    <h3>Full Logs</h3><table>
        <tr>
            <th>Driver Name</th>
            <th>Log Date</th>
            <th>Takings</th>
            <th>Mileage</th>
            <th>Number of Journeys</th>
            <th>Fuel Cost</th>
        </tr>";


            while ($row = $result->fetch_assoc()) {

                $field0name = $row['first_name'] . " " . $row['surname'];
                $field1name = $row["log_date"];
                $field2name = $row["daily_takings"];
                $field3name = $row["daily_mileage"];
                $field4name = $row["no_journeys"];
                $field5name = $row["fuel_cost"];
                echo "<tr>";
                echo "<td>" . $field0name . "</td>";
                echo "<td>" . $field1name . "</td>";
                echo "<td>£" . $field2name . "</td>";
                echo "<td>" . $field3name . "</td>";
                echo "<td>" . $field4name . "</td>";
                echo "<td>£" . $field5name . "</td>";
                echo "</tr>";
            }
            echo "</table>";

            $sql = "SELECT  ROUND(AVG(l.daily_takings),2), ROUND(AVG(l.daily_mileage),2), ROUND(AVG(l.no_journeys),0), 
ROUND(AVG(l.fuel_cost),2),ROUND(SUM(l.daily_takings),2), ROUND(SUM(l.daily_mileage),2), ROUND(SUM(l.no_journeys),0),
 ROUND(SUM(l.fuel_cost),2), d.first_name, d.surname FROM logs l, drivers d WHERE
 TIMESTAMP(l.log_date) < now() AND d.driver_ID = l.driver_ID AND TIMESTAMP(log_date) > (now()+ INTERVAL -7 DAY)";
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
            echo "<td>£" . $row['ROUND(AVG(l.daily_takings),2)'] . "</td>";
            echo "<td>" . $row['ROUND(AVG(l.daily_mileage),2)'] . "</td>";
            echo "<td>" . $row['ROUND(AVG(l.no_journeys),0)'] . "</td>";
            echo "<td>£" . $row['ROUND(AVG(l.fuel_cost),2)'] . "</td>";
            echo "</tr>";
            echo "</table>";

            echo "<h3>Totals</h3>

<table>
<tr>
<th>Takings</th>
<th>Mileage</th>
<th>Number of Journeys</th>
<th>Fuel Cost</th>
</tr>";
            echo "<tr>";
            echo "<td>£" . $row['ROUND(SUM(l.daily_takings),2)'] . "</td>";
            echo "<td>" . $row['ROUND(SUM(l.daily_mileage),2)'] . "</td>";
            echo "<td>" . $row['ROUND(SUM(l.no_journeys),0)'] . "</td>";
            echo "<td>£" . $row['ROUND(SUM(l.fuel_cost),2)'] . "</td>";
            echo "</tr>";
            echo "</table>";
        }
        elseif($period =="30_days"){
            require 'PHP_Scripts/db_connect.php';
            $sql = "SELECT l.log_date, l.daily_takings, l.daily_mileage, l.no_journeys, l.fuel_cost, d.first_name, d.surname 
    FROM logs l, drivers d WHERE TIMESTAMP(l.log_date) < now() AND d.driver_ID = l.driver_ID 
    AND TIMESTAMP(l.log_date) > (now()+ INTERVAL -30 DAY)";
            $result = mysqli_query($connection, $sql);

            $num_rows = mysqli_num_rows($result);
            echo "
    <h3>Full Logs</h3><table>
        <tr>
            <th>Driver Name</th>
            <th>Log Date</th>
            <th>Takings</th>
            <th>Mileage</th>
            <th>Number of Journeys</th>
            <th>Fuel Cost</th>
        </tr>";


            while ($row = $result->fetch_assoc()) {

                $field0name = $row['first_name'] . " " . $row['surname'];
                $field1name = $row["log_date"];
                $field2name = $row["daily_takings"];
                $field3name = $row["daily_mileage"];
                $field4name = $row["no_journeys"];
                $field5name = $row["fuel_cost"];
                echo "<tr>";
                echo "<td>" . $field0name . "</td>";
                echo "<td>" . $field1name . "</td>";
                echo "<td>£" . $field2name . "</td>";
                echo "<td>" . $field3name . "</td>";
                echo "<td>" . $field4name . "</td>";
                echo "<td>£" . $field5name . "</td>";
                echo "</tr>";
            }
            echo "</table>";

            $sql = "SELECT  ROUND(AVG(l.daily_takings),2), ROUND(AVG(l.daily_mileage),2), ROUND(AVG(l.no_journeys),0), 
ROUND(AVG(l.fuel_cost),2),ROUND(SUM(l.daily_takings),2), ROUND(SUM(l.daily_mileage),2), ROUND(SUM(l.no_journeys),0),
 ROUND(SUM(l.fuel_cost),2), d.first_name, d.surname FROM logs l, drivers d WHERE 
 TIMESTAMP(l.log_date) < now() AND d.driver_ID = l.driver_ID AND TIMESTAMP(l.log_date) > (now()+ INTERVAL -30 DAY)";
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
            echo "<td>£" . $row['ROUND(AVG(l.daily_takings),2)'] . "</td>";
            echo "<td>" . $row['ROUND(AVG(l.daily_mileage),2)'] . "</td>";
            echo "<td>" . $row['ROUND(AVG(l.no_journeys),0)'] . "</td>";
            echo "<td>£" . $row['ROUND(AVG(l.fuel_cost),2)'] . "</td>";
            echo "</tr>";
            echo "</table>";

            echo "<h3>Totals</h3>

<table>
<tr>
<th>Takings</th>
<th>Mileage</th>
<th>Number of Journeys</th>
<th>Fuel Cost</th>
</tr>";
            echo "<tr>";
            echo "<td>£" . $row['ROUND(SUM(l.daily_takings),2)'] . "</td>";
            echo "<td>" . $row['ROUND(SUM(l.daily_mileage),2)'] . "</td>";
            echo "<td>" . $row['ROUND(SUM(l.no_journeys),0)'] . "</td>";
            echo "<td>£" . $row['ROUND(SUM(l.fuel_cost),2)'] . "</td>";
            echo "</tr>";
            echo "</table>";
        }
        elseif ($period=="365_days"){
            require 'PHP_Scripts/db_connect.php';
            $sql = "SELECT l.log_date, l.daily_takings, l.daily_mileage, l.no_journeys, l.fuel_cost, d.first_name, d.surname 
    FROM logs l, drivers d WHERE TIMESTAMP(l.log_date) < now() AND d.driver_ID = l.driver_ID 
    AND TIMESTAMP(l.log_date) > (now()+ INTERVAL -365 DAY)";
            $result = mysqli_query($connection, $sql);

            $num_rows = mysqli_num_rows($result);
            echo "
    <h3>Full Logs</h3><table>
        <tr>
            <th>Driver Name</th>
            <th>Log Date</th>
            <th>Takings</th>
            <th>Mileage</th>
            <th>Number of Journeys</th>
            <th>Fuel Cost</th>
        </tr>";


            while ($row = $result->fetch_assoc()) {

                $field0name = $row['first_name'] . " " . $row['surname'];
                $field1name = $row["log_date"];
                $field2name = $row["daily_takings"];
                $field3name = $row["daily_mileage"];
                $field4name = $row["no_journeys"];
                $field5name = $row["fuel_cost"];
                echo "<tr>";
                echo "<td>" . $field0name . "</td>";
                echo "<td>" . $field1name . "</td>";
                echo "<td>£" . $field2name . "</td>";
                echo "<td>" . $field3name . "</td>";
                echo "<td>" . $field4name . "</td>";
                echo "<td>£" . $field5name . "</td>";
                echo "</tr>";
            }
            echo "</table>";

            $sql = "SELECT  ROUND(AVG(l.daily_takings),2), ROUND(AVG(l.daily_mileage),2), ROUND(AVG(l.no_journeys),0), 
ROUND(AVG(l.fuel_cost),2),ROUND(SUM(l.daily_takings),2), ROUND(SUM(l.daily_mileage),2), ROUND(SUM(l.no_journeys),0),
 ROUND(SUM(l.fuel_cost),2), d.first_name, d.surname FROM logs l, drivers d WHERE 
 TIMESTAMP(l.log_date) < now() AND d.driver_ID = l.driver_ID AND TIMESTAMP(l.log_date) > (now()+ INTERVAL -365 DAY)";
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
            echo "<td>£" . $row['ROUND(AVG(l.daily_takings),2)'] . "</td>";
            echo "<td>" . $row['ROUND(AVG(l.daily_mileage),2)'] . "</td>";
            echo "<td>" . $row['ROUND(AVG(l.no_journeys),0)'] . "</td>";
            echo "<td>£" . $row['ROUND(AVG(l.fuel_cost),2)'] . "</td>";
            echo "</tr>";
            echo "</table>";

            echo "<h3>Totals</h3>

<table>
<tr>
<th>Takings</th>
<th>Mileage</th>
<th>Number of Journeys</th>
<th>Fuel Cost</th>
</tr>";
            echo "<tr>";
            echo "<td>£" . $row['ROUND(SUM(l.daily_takings),2)'] . "</td>";
            echo "<td>" . $row['ROUND(SUM(l.daily_mileage),2)'] . "</td>";
            echo "<td>" . $row['ROUND(SUM(l.no_journeys),0)'] . "</td>";
            echo "<td>£" . $row['ROUND(SUM(l.fuel_cost),2)'] . "</td>";
            echo "</tr>";
            echo "</table>";
        }

    }
    ?>
        </div>
    </div>
</main>
<footer>
    Duncan Orr 1809591 CMM007 <a href="about.html">About Fleet Manager</a>
</footer>
</body>
</html>