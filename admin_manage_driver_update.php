<?php
require 'templates/credentials/admin_only.php';
require "PHP_Scripts/db_connect.php";
$email = $_POST['email'];
$sql= "Select * From drivers where email = '$email'";
$result = mysqli_query($connection, $sql);
$row=mysqli_fetch_array($result);
$first_name = $row['first_name'];
$surname = $row['surname'];
$vehicle_reg = $row['vehicle_reg'];
$licence_number = $row['licence_number'];
$licence_url = $row['licence_url'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Driver Details</title>
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
            <form  action="PHP_Scripts/admin_edit_driver.php" method="post">
                <h1>Update Driver Details</h1>
                <p>Update the details shown below.</p>
                <p>Email address: <input type="text" name="email" value = "<?php echo "{$email}"?>" readonly></p>
                <p>First Name: <input type="text" name="first_name" maxlength="15" value = "<?php echo "{$first_name}"?>"></p>
                <p>Surname: <input type="text" name="surname" maxlength="20" value = "<?php echo "{$surname}"?>"></p>
                <p>Vehicle Registration Number:<input type="text" name="registration" maxlength="7" value = "<?php echo "{$vehicle_reg}"?>"></p>
                <p>Licence Number: <input type="text" name="licence" maxlength="16" value = "<?php echo "{$licence_number}"?>"></p>
                <button type="submit">Update Driver Details</button>
            </form>
            <form action="PHP_Scripts/admin_edit_driver_licence.php" method="post" enctype="multipart/form-data">
                <h4>Update Licence:</h4>
                    <p><input type="file" name="fileToUpload" id="fileToUpload">
                    <input type="hidden" name="filename" id="filename"></p>
                    <input type="hidden" name = "email2" value = "<?php echo "{$email}"; ?>">
                <p>Current Licence: <a target ='_blank' href ='<?php echo "{$licence_url}"?>'><img src = '<?php echo "{$licence_url}"?>' alt="drivers licence" height = 150px></a></p>
                <button type="submit">Update Driver's Licence</button>
            </form>
        </div>
    </div>
</div>
<footer>
    Duncan Orr 1809591 CMM007 <a href="about.html">About Fleet Manager</a>
</footer>
</body>
</html>