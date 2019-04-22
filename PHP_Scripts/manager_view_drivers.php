<?php
session_start();
require "db_connect.php";
$driver_ID = mysqli_real_escape_string($connection, $_GET['driver']);

$sql= "Select * From drivers where driver_ID = '$driver_ID'";
$result = mysqli_query($connection, $sql);
$row=mysqli_fetch_array($result);
$email = $row['email'];
$first_name = $row['first_name'];
$surname = $row['surname'];
$vehicle_reg = $row['vehicle_reg'];
$licence_number = $row['licence_number'];
$licence_url = $row['licence_url'];

echo ' <div id="details_table" class="details_table" style="margin-top:100px">';
            echo'    <h2>My Details</h2>';
                echo'<table>
                    <tr>Email address: '.$email.'<br></tr>
                    <tr>First Name: '.$first_name.'<br></tr>
                    <tr>Surname: '.$surname.'<br></tr>
                    <tr>Vehicle Registration Number: '.$vehicle_reg.'<br></tr>
                    <tr>Licence Number: '.$licence_number.'<br></tr>
                </table>';
               echo'  Current Drivers License <a target ="_blank" href = '.$licence_url.'><img src="'.$licence_url.'" alt="drivers licence" height = 200px></a>';
                echo'<p>Please inform an administrator if any of these details are incorrect</p>
            </div>'
?>