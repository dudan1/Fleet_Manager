<?php
session_start();
require 'db_connect.php';
// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$sql = "SELECT u.email, a.email FROM users u, administrators a WHERE a.email = '$_SESSION[name]' AND u.email = a.email";
$result =mysqli_query($connection,$sql) or die(mysqli_error($connection));

$count =mysqli_num_rows($result);

if($count == 0) {

// prepare and bind
    $stmt = $connection->prepare("INSERT INTO administrators (first_name, surname, phone_number, email) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $firstname, $surname, $phone_number, $email);

// set parameters and execute
    $firstname = mysqli_real_escape_string($connection, $_POST['first_name']);
    $surname = mysqli_real_escape_string($connection,$_POST['surname']);
    $phone_number = mysqli_real_escape_string($connection,$_POST['phone_number']);
    $email = mysqli_real_escape_string($connection,$_SESSION['name']);

    $stmt->execute();

    echo "New records created successfully";

    $stmt->close();
    $connection->close();
}
elseif($count == 1){
    // prepare and bind
    $stmt = $connection->prepare("UPDATE administrators SET first_name = ?, surname = ?, phone_number = ?");
    $stmt->bind_param("sss",$firstname, $surname, $phone_number);

// set parameters and execute
    $firstname = mysqli_real_escape_string($connection, $_POST['first_name']);
    $surname = mysqli_real_escape_string($connection,$_POST['surname']);
    $phone_number = mysqli_real_escape_string($connection,$_POST['phone_number']);

    $stmt->execute();

    echo "Records updated successfully";

    $stmt->close();
    $connection->close();
}
else{
    echo "error";
}
header('Location:../admin_home.php');
?>