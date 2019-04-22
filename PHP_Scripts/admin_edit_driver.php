<?php
session_start();
require 'db_connect.php';
// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if($stmt = $connection->prepare("UPDATE drivers SET first_name = ?, surname = ?, vehicle_reg = ?, licence_number = ?, licence_points = ? WHERE email = ?")) {
   if($stmt->bind_param("ssssis", $first_name, $surname, $vehicle_reg, $licence_number, $licence_points, $email)){

    $email = $_POST['email'];
    $first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
    $surname = mysqli_real_escape_string($connection, $_POST['surname']);
    $vehicle_reg = mysqli_real_escape_string($connection, $_POST['registration']);
    $licence_number = mysqli_real_escape_string($connection, $_POST['licence']);
    $licence_points = mysqli_real_escape_string($connection, $_POST['points']);
    if($stmt->execute()){
    echo "New records created successfully";

    $stmt->close();
    $connection->close();
    header("Location:../admin_manage_driver.php");
}
}
}

?>