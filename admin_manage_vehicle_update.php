<?php
require 'templates/credentials/admin_only.php';

require "PHP_Scripts/db_connect.php";
$vehicle_reg = $_POST['vehicle_reg'];
$sql="SELECT * From vehicles WHERE vehicle_reg = '$vehicle_reg'";
$result = mysqli_query($connection, $sql);
$row=mysqli_fetch_array($result);
$make = $row['make'];
$model = $row['model'];
$date_prev_MOT = $row['date_prev_MOT'];
$date_next_MOT = $row['date_next_MOT'];
$car_tax_due_date = $row['car_tax_due_date'];
$insurer_name = $row['insurer_name'];
$insurance_policy_no = $row['insurance_policy_no'];
$insurance_renewal_date = $row['insurance_renewal_date'];
$last_service = $row['last_service'];
$driver_ID = $row['driver_ID'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Vehicles</title>
    <link rel="stylesheet" type="text/css" href="CSS/styles.css">
    <link rel="stylesheet" type="text/css" href="CSS/unsemantic-grid-responsive-tablet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="js/scripts.js"></script>
</head>
<body>
<header>
    <?php require 'templates/nav_bar/admin_nav_bar.php';?>
</header>
<main>
    <div class="grid-container">
        <div class="grid-100">
            <div id="details" class="details_form" style="margin-top:100px">
                <form  action="PHP_Scripts/admin_edit_vehicle.php" method="post">
                    <h1>Update Vehicle Details</h1>
                    <p>Update details below. Ensure all details are correct</p>
                    <p>Registration Number: <input type="text" name="vehicle_reg" maxlength="7" value='<?php echo"{$vehicle_reg}" ?>'></p>
                    <p>Driver Name: <select name="driver_ID"  value='<?php echo"{$driver_ID}" ?>'>
                            <option vaue=""></option>
                            <?php
                            require_once ('PHP_Scripts/db_connect.php');
                            $sql = "SELECT driver_ID, first_name, surname FROM drivers";
                            $result=mysqli_query($connection,$sql) or die(mysqli_error($connection));
                            while($row =mysqli_fetch_array($result)){


                                echo "<option value='{$row['driver_ID']}'>{$row['first_name']} {$row['surname']}</option>";
                            }
                            ?>
                        </select></p>
                    <p>Make: <input type="text" name="make" maxlength="20"  value='<?php echo"{$make}" ?>'></p>
                    <p>Model: <input type="text" name="model" maxlength="20"  value='<?php echo"{$model}" ?>'></p>
                    <p>Date of Last MOT: <input type="date" name="date_prev_MOT"  value='<?php echo"{$date_prev_MOT}" ?>'></p>
                    <p>Date of Next MOT: <input type="date" name="date_next_MOT"  value='<?php echo"{$date_next_MOT}" ?>'></p>
                    <p>Date Car Tax Due: <input type="date" name="car_tax_due_date"  value='<?php echo"{$car_tax_due_date}" ?>'></p>
                    <p>Name of Insurer: <input type="text" name="insurer_name" maxlength="20"  value='<?php echo"{$insurer_name}" ?>'></p>
                    <p>Insurance Policy Number: <input type="text" name="insurance_policy_no" maxlength="20"  value='<?php echo"{$insurance_policy_no}" ?>'></p>
                    <p>Date of Insurance Renewal: <input type="date" name="insurance_renewal_date"  value='<?php echo"{$insurance_renewal_date}" ?>'></p>
                    <p>Date of Last Service: <input type="date" name="last_service"  value='<?php echo"{$last_service}" ?>'></p>

                    <button type="submit">Update Vehicle</button>
                </form>
            </div>
        </div>
    </div>
</main>
<footer>
    Duncan Orr 1809591 CMM007 <a href="about.php">About Fleet Manager</a>
</footer>
</body>
</html>