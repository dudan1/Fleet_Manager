<?php
session_start();
require 'db_connect.php';
// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
$email=$_POST['email'];
$option = $_POST['del_sus'];
if($option == 'delete'){

    $sql = "DELETE FROM users WHERE email='$email'";
    if(mysqli_query($connection,$sql)or die(mysqli_error($connection))){
        echo "deleted";
       header('Location:../admin_manage_accounts.php');
    }
}
elseif($option == 'suspend') {
    $sql = "UPDATE users SET is_suspended = 1 WHERE email = '$email'";
    if (mysqli_query($connection, $sql) or die(mysqli_error($connection))) {

        echo "suspended";
        header('Location:../admin_manage_accounts.php');
    }
}
elseif($option == 'reactivate'){
    $sql = "UPDATE users SET is_suspended = 0 WHERE email = '$email'";
    if(mysqli_query($connection,$sql)or die(mysqli_error($connection))){

        echo "reactivated";
        header('Location:../admin_manage_accounts.php');
        }
}
    else{
    echo "there has been an error";
    }
?>