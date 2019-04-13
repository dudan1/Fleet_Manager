<?php
session_start();
require_once('db_connect.php');

// Check connection
if ($connection === false) {
    die("Error: Could not connect. " . mysqli_connect_error());
}
$email = mysqli_real_escape_string($connection, $_POST['email']);
$password = mysqli_real_escape_string($connection, $_POST['password']);




$sql = "SELECT * FROM users WHERE email = '$email'";

$result =mysqli_query($connection,$sql) or die(mysqli_error($connection));

    $count =mysqli_num_rows($result);

    if($count > 0){

    while($row = mysqli_fetch_array($result)) {
        if (password_verify($password, $row['password'])) {

            $_SESSION['name'] = $email;

            if ($row['user_type'] == 'admin') {
                $_SESSION['user_type'] = $row['user_type'];
                header('Location:../admin_home.php');

            } elseif ($row['user_type'] == 'driver') {
                $_SESSION['user_type'] = $row['user_type'];
                header('Location:../driver_home.php');
            }
              elseif ($row['user_type'] == 'manager') {
                $_SESSION['user_type'] = $row['user_type'];
                header('Location:../manager.php');
            }
            else{
                echo "invalid user_type error";
            }
        }
        else {
            session_destroy();
            $error = 'Your login email or password is invalid';
            header('Location:../index.php');

        }
    }
}else{
    session_destroy();
    $error = 'Your login email or password is invalid';
    header('Location:../index.php');
}
