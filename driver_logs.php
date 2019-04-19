<?php
require 'templates/credentials/driver_creds.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Logs</title>
    <link rel="stylesheet" type="text/css" href="CSS/styles.css">
    <link rel="stylesheet" type="text/css" href="CSS/unsemantic-grid-responsive-tablet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="js/scripts.js"></script>
    <script type="text/javascript">
        function getLogs(str) {
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
                xmlhttp.open("GET","PHP_Scripts/driver_view_logs.php?period="+str,true);
                xmlhttp.send();
            }
        }

    </script>
</head>
<body>
<header>
    <?php require 'templates/nav_bar/driver_nav_bar.php';?>
</header>
<div class="log_form_container" style="padding-top: 200px">
<form action="PHP_Scripts/driver_view_logs.php">
    <h3>Select which logs you want to display</h3>
    Time Period: <select id="period" name="period" onchange="getLogs(this.value)">
        <option value =""></option>
        <option value ="7_days">Last Week</option>
        <option value ="30_days">Last Month</option>
        <option value ="365_days">Last Year</option>
        <option value ="all_days">Total</option>
    </select>
</form>
</div>
<div id="logTable"><b>Logs will be listed here.</b></div>

<footer>
    Duncan Orr 1809591 CMM007 <a href="about.html">About Fleet Manager</a>
</footer>
</body>
</html>