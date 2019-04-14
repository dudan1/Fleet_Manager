<?php
session_start();
require 'db_connect.php';
// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
$vehicle_reg= $_POST['vehicle_reg'];
$sql = "DELETE FROM vehicles WHERE vehicle_reg ='$vehicle_reg'";
if(mysqli_query($connection,$sql)or die(mysqli_error($connection))){
    echo "deleted";
    header('Location:../admin_manage_vehicle.php');
}