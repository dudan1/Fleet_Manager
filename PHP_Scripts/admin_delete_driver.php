<?php
session_start();
require 'db_connect.php';
// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
$email= $_POST['email'];
$sql = "DELETE FROM drivers WHERE email='$email'";
if(mysqli_query($connection,$sql)or die(mysqli_error($connection))) {
    echo "deleted";
    $fileLink = $_POST['email'];
    //The name of the folder.
    $folder = '../uploads/' . $fileLink;

//Get a list of all of the file names in the folder.
    $files = glob($folder . '/*');

//Loop through the file list.
    foreach ($files as $file) {
        //Make sure that this is a file and not a directory.
        if (is_file($file)) {
            //Use the unlink function to delete the file.
            unlink($file);
        }
        rmdir('../uploads/' . $fileLink);
    }
}
header('Location:../admin_manage_driver.php');