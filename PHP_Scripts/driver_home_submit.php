<?php
session_start();
require 'db_connect.php';
// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// prepare and bind
if($stmt = $connection->prepare("INSERT INTO logs (driver_ID, daily_takings, daily_mileage, no_journeys, fuel_cost) VALUES (?, ?, ?, ?, ?)")){
    if($stmt->bind_param("sddid", $driver_ID, $daily_takings, $daily_mileage, $no_journeys, $fuel_cost)){
// set parameters and execute

        $driver_ID = $_SESSION['driver_ID'];

        $daily_takings = mysqli_real_escape_string($connection, $_POST['daily_takings']);

        $daily_mileage= mysqli_real_escape_string($connection, $_POST['daily_mileage']);

        $no_journeys = mysqli_real_escape_string($connection, $_POST['no_journeys']);

        $fuel_cost = mysqli_real_escape_string($connection, $_POST['fuel_cost']);

        if($stmt->execute()){

            echo "New records created successfully";

            $stmt->close();
            $connection->close();
        }
        else{
            echo"failed to execute";
        }
    }
    else{echo "failed to bind";
    }
}
else {
    echo "failed to prepare";
}

header("Location:../driver_home.php");
?>