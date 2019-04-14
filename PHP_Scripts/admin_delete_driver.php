<?php
session_start();
require 'db_connect.php';
// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
$email= $_POST['email'];
$sql = "DELETE FROM drivers WHERE email='$email'";
if(mysqli_query($connection,$sql)or die(mysqli_error($connection))){
    echo "deleted";
    header('Location:../admin_manage_driver.php');
}