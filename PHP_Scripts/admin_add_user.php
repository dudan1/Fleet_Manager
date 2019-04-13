<?php
session_start();
require 'db_connect.php';
// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if($_POST['password1'] == $_POST['password2']) {
// prepare and bind
    $stmt = $connection->prepare("INSERT INTO users (email, password, user_type) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $email, $password, $user_type);

// set parameters and execute
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = password_hash($_POST['password1'], PASSWORD_DEFAULT);
    $user_type = mysqli_real_escape_string($connection, $_POST['user_type']);

    $stmt->execute();

    echo "New records created successfully";

    $stmt->close();
    $connection->close();
    header("Location:../admin_manage_accounts.php");
}
else{
    echo "passwords do not match";
}
?>