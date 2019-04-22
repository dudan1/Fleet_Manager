<?php
session_start();
require 'db_connect.php';
// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// prepare and bind
   if($stmt = $connection->prepare("INSERT INTO drivers (email, first_name, surname, vehicle_reg, licence_number, licence_url, licence_points) VALUES (?, ?, ?, ?, ?, ?, ?)")){
        if($stmt->bind_param("ssssssi", $email, $first_name, $surname, $vehicle_reg, $licence_number, $url, $licence_points)){
// set parameters and execute

        $email = $_POST['email'];
        echo "$email<br>";
        $first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
        echo "$first_name<br>";
        $surname = mysqli_real_escape_string($connection, $_POST['surname']);
        echo "$surname<br>";
        $vehicle_reg = mysqli_real_escape_string($connection, $_POST['registration']);
        echo "$vehicle_reg<br>";
        $licence_number = mysqli_real_escape_string($connection, $_POST['licence']);
        echo "$licence_number<br>";
        $link = "uploads/".$email."/".$_POST['filename'];
        $url = mysqli_real_escape_string($connection, $link);
        echo "$url<br>";
        $licence_points = mysqli_real_escape_string($connection, $_POST['points']);


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

if(!is_dir('../uploads/'.$email)) {
    $new_dir = "../uploads/" . $email;
    mkdir($new_dir, 0777);
}
$target_dir = "../uploads/".$email."/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
}
else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        // Check connection
        if ($connection === false) {
            die("Error: Could not connect. " . mysqli_connect_error());
        }
    }
}
    header("Location:../admin_manage_driver.php");
?>