<?php
require 'templates/credentials/admin_only.php';

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
        <div class="grid-50">
            <div id="details" class="details_form" style="margin-top:100px">
                <form  action="PHP_Scripts/admin_add_vehicle.php" method="post">
                    <h1>Add New Vehicle Details</h1>
                    <p>Add new vehicle details below. Ensure all details are correct</p>
                    <p>Registration Number: <input type="text" name="vehicle_reg" maxlength="7"></p>
                    <p>Driver Name: <select name="driver_ID">
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
                    <p>Make: <input type="text" name="make" maxlength="20"></p>
                    <p>Model: <input type="text" name="model" maxlength="20"></p>
                    <p>Date of Last MOT: <input type="date" name="date_prev_MOT"></p>
                    <p>Date of Next MOT: <input type="date" name="date_next_MOT"></p>
                    <p>Date Car Tax Due: <input type="date" name="car_tax_due_date"></p>
                    <p>Name of Insurer: <input type="text" name="insurer_name" maxlength="20"></p>
                    <p>Insurance Policy Number: <input type="text" name="insurance_policy_no" maxlength="20"></p>
                    <p>Date of Insurance Renewal: <input type="date" name="insurance_renewal_date"></p>
                    <p>Date of Last Service: <input type="date" name="last_service"></p>

                    <button type="submit">Add New Vehicle</button>
                </form>
            </div>
        </div>
        <div class="grid-50">
            <div id="details" class="details_form" style="margin-top:100px">
                <form  action="admin_manage_vehicle_update.php" method="post" enctype="multipart/form-data">
                    <h1>Update Vehicle Details</h1>
                    <p>Update selected vehicle details.</p>
                    <p>Vehicle Registration: <select name="vehicle_reg">
                            <?php
                            require_once ('PHP_Scripts/db_connect.php');
                            $sql = "SELECT vehicle_reg FROM vehicles";
                            $result=mysqli_query($connection,$sql) or die(mysqli_error($connection));
                            while($row =mysqli_fetch_array($result)){
                                echo "<option value='{$row['vehicle_reg']}'>{$row['vehicle_reg']}</option>";
                            }
                            ?>
                        </select></p>
                    <button type="submit">Edit Vehicle</button>
                </form>
                <form  action="PHP_Scripts/admin_delete_vehicle.php" method="post">
                    <h1>Clear Vehicle Details</h1>
                    <p>Select a Vehicle details to delete.</p>
                    <p>Vehicle Registration: <select name="vehicle_reg">
                            <?php
                            require_once ('PHP_Scripts/db_connect.php');
                            $sql = "SELECT vehicle_reg FROM vehicles";
                            $result=mysqli_query($connection,$sql) or die(mysqli_error($connection));
                            while($row =mysqli_fetch_array($result)){
                                echo "<option value='{$row['vehicle_reg']}'>{$row['vehicle_reg']}</option>";
                            }
                            ?>
                        </select></p>
                    <button type="submit">Clear Vehicle Details</button>
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