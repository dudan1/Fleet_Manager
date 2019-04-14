<?php
session_start();
require 'db_connect.php';
// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
$stmt = $connection->prepare("UPDATE users SET password = ? WHERE email = ?");
$stmt->bind_param("ss", $hash, $email);

$email = $_POST['email'];
$newpassword = mysqli_real_escape_string($connection, $_POST['password']);
$hash = password_hash($newpassword, PASSWORD_DEFAULT);

$stmt->execute();

echo "New records created successfully";

$stmt->close();
$connection->close();
header("Location:../admin_manage_accounts.php");