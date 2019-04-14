<?php
session_start();
require 'db_connect.php';
// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
$stmt = $connection->prepare("UPDATE drivers SET first_name = ?, surname = ?, vehicle_reg = ?, licence_number = ? WHERE email = ?");
$stmt->bind_param("sssss", $first_name, $surname, $vehicle_reg, $licence_number, $email);

$email = $_POST['email'];
$first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
$surname = mysqli_real_escape_string($connection, $_POST['surname']);
$vehicle_reg = mysqli_real_escape_string($connection, $_POST['registration']);
$licence_number = mysqli_real_escape_string($connection, $_POST['licence']);

$stmt->execute();

echo "New records created successfully";

$stmt->close();
$connection->close();
header("Location:../admin_manage_driver.php");
?>