<?php
require 'templates/credentials/admin_only.php';
require "PHP_Scripts/db_connect.php";
$email = $_POST['email'];
$sql= "Select * From managers where email = '$email'";
$result = mysqli_query($connection, $sql);
$row=mysqli_fetch_array($result);
$first_name = $row['first_name'];
$surname = $row['surname'];
$phone_number = $row['phone_number'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Manager Details</title>
    <link rel="stylesheet" type="text/css" href="CSS/styles.css">
    <link rel="stylesheet" type="text/css" href="CSS/unsemantic-grid-responsive-tablet.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="js/scripts.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('input[type="file"]').change(function(e){
                var fileName = e.target.files[0].name;
                document.getElementById('filename').value = fileName
            });
        });
    </script>
</head>
<body>
<header>
    <?php require 'templates/nav_bar/admin_nav_bar.php';?>
</header>
<div class="grid-container">
    <div class="grid-100">
        <div id="details" class="details_form" style="margin-top:100px">
            <form  action="PHP_Scripts/admin_edit_manager.php" method="post">
                <h1>Update Manager Details</h1>
                <p>Update the details shown below.</p>
                <p>Email address: <input type="text" name="email" value = "<?php echo "{$email}"?>" readonly></p>
                <p>First Name: <input type="text" name="first_name" maxlength="15" value = "<?php echo "{$first_name}"?>"></p>
                <p>Surname: <input type="text" name="surname" maxlength="20" value = "<?php echo "{$surname}"?>"></p>
                <p>Phone Number: <input type="text" name="phone_number" maxlength="20" value = "<?php echo "{$phone_number}"?>"></p>
                <button type="submit">Update Manager Details</button>
            </form>
        </div>
    </div>
</div>
<footer>
    Duncan Orr 1809591 CMM007 <a href="about.html">About Fleet Manager</a>
</footer>
</body>
</html>