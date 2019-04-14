<?php
session_start();
require 'db_connect.php';
// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
// prepare and bind
if($stmt = $connection->prepare("UPDATE vehicles SET vehicle_reg = ?, driver_ID = ?, make = ?, model = ?, date_prev_MOT = ?,
date_next_MOT = ?, car_tax_due_date = ?, insurer_name = ?, insurance_policy_no = ?, insurance_renewal_date = ?, last_service = ?")) {

    if ($stmt->bind_param("sssssssssss", $vehicle_reg, $driver_id, $make, $model, $date_prev_MOT,
        $date_next_MOT, $car_tax_due_date, $insurer_name, $insurance_policy_no, $insurance_renewal_date, $last_service)) {

// set parameters and execute
        $vehicle_reg = mysqli_real_escape_string($connection, $_POST['vehicle_reg']);echo "$vehicle_reg<br>";
        $driver_id = mysqli_real_escape_string($connection, $_POST['driver_ID']);echo "$driver_id<br>";
        $make = mysqli_real_escape_string($connection, $_POST['make']);echo "$make<br>";
        $model = mysqli_real_escape_string($connection, $_POST['model']);echo "$model<br>";
        $date_prev_MOT = date(mysqli_real_escape_string($connection, $_POST['date_prev_MOT']));echo "$date_prev_MOT<br>";
        $date_next_MOT = date(mysqli_real_escape_string($connection, $_POST['date_next_MOT']));echo "$date_next_MOT<br>";
        $car_tax_due_date = date(mysqli_real_escape_string($connection, $_POST['car_tax_due_date']));echo "$car_tax_due_date<br>";
        $insurer_name = mysqli_real_escape_string($connection, $_POST['insurer_name']);echo "$insurer_name<br>";
        $insurance_policy_no = mysqli_real_escape_string($connection, $_POST['insurance_policy_no']);echo "$insurance_policy_no<br>";
        $insurance_renewal_date = date(mysqli_real_escape_string($connection, $_POST['insurance_renewal_date']));echo "$insurance_renewal_date<br>";
        $last_service = date(mysqli_real_escape_string($connection, $_POST['last_service']));echo "$last_service<br>";

        if ($stmt->execute()) {

            echo "New records created successfully";

            $stmt->close();
            $connection->close();
        } else {
            echo "failed to execute";
        }
    } else {
        echo "failed to bind parameters";
    }
}

else {
    echo "prepare failed";
}
header("Location:../admin_manage_vehicle.php");