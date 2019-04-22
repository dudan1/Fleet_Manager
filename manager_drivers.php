<?php
require 'templates/credentials/manager_creds.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Drivers</title>
    <link rel="stylesheet" type="text/css" href="CSS/styles.css">
    <link rel="stylesheet" type="text/css" href="CSS/unsemantic-grid-responsive-tablet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="js/scripts.js"></script>
    <script type="text/javascript">
        function getDrivers(str) {
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
                xmlhttp.open("GET","PHP_Scripts/manager_view_drivers.php?driver="+str,true);
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
    <div class="log_form_container" style="padding-top: 200px">
        <form action="PHP_Scripts/manager_view_drivers.php">
            <h3>Select which drivers' details you want to display</h3>
            Driver Name: <select id="driver" name="driver" onchange="getDrivers(this.value)">
                <option value =""></option>
                <?php
                require_once ('PHP_Scripts/db_connect.php');
                $sql = "SELECT driver_ID, first_name, surname FROM drivers";
                $result=mysqli_query($connection,$sql) or die(mysqli_error($connection));
                while($row =mysqli_fetch_array($result)){
                    echo "<option value='{$row['driver_ID']}'>{$row['first_name']} {$row['surname']}</option>";
                }
                ?>


            </select>
        </form>
    </div>
    <div id="logTable"><b>Driver details will be listed here.</b></div>
</main>
<footer>
    Duncan Orr 1809591 CMM007 <a href="about.php">About Fleet Manager</a>
</footer>
</body>
</html>