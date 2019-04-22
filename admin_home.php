<?php
require 'templates/credentials/admin_only.php';
require 'PHP_Scripts/db_connect.php';

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$sql = "SELECT first_name, surname, phone_number FROM administrators WHERE email = '$_SESSION[name]'";
$result =mysqli_query($connection,$sql) or die(mysqli_error($connection));
$row = mysqli_fetch_array($result);
$firstname =$row['first_name'];
$surname =$row['surname'];
$phone_number =$row['phone_number'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Administrator Home</title>
    <link rel="stylesheet" type="text/css" href="CSS/styles.css">
    <link rel="stylesheet" type="text/css" href="CSS/unsemantic-grid-responsive-tablet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="js/scripts.js"></script>
</head>

<body>
<header>
    <?php require 'templates/nav_bar/admin_nav_bar.php';?>
</header>
<main>
    <div class="grid-container">
        <div class="grid-100">
            <div id="details" class="details_form" style="margin-top:100px">
                <form  action="PHP_Scripts/admin_update_admin.php" method="post">
                    <h1>Your details</h1>
                    <p>Please check that the following details are correct.</p>
                    <p>Your first name: <input type="text" required name="first_name" maxlength="20" value ="<?php echo $firstname ?>"/></p>
                    <p>Your surname: <input type="text" required name="surname" maxlength="20" value ="<?php echo $surname ?>"/></p>
                    <p>Phone number : <input type="text" required name="phone_number" maxlength="14" value ="<?php echo $phone_number ?>"></p>
                    <button type="submit">Update details</button>
                </form>
            </div>
        </div>
    </div>
</main>
<footer>
    Duncan Orr 1809591 CMM007 <a href="about.php">About Fleet Manager</a>
</footer>
</body>
</html>