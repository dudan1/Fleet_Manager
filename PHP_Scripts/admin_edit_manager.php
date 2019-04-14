<?php
session_start();
require 'db_connect.php';
// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
$stmt = $connection->prepare("UPDATE managers SET first_name = ?, surname = ?, phone_number = ? WHERE email = ?");
$stmt->bind_param("ssss", $first_name, $surname, $phone_number, $email);

$email = $_POST['email'];
$first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
$surname = mysqli_real_escape_string($connection, $_POST['surname']);
$phone_number = mysqli_real_escape_string($connection, $_POST['phone_number']);

$stmt->execute();

echo "New records created successfully";

$stmt->close();
$connection->close();
header("Location:../admin_manage_manager.php");
?>