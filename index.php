<?php
session_start();
$_SESSION['user_type'] =  "a";
if(!isset($_SESSION['name'])){

if($_SESSION["user_type"]== 'admin'){
    header('Location:admin_home.php');
}
elseif($_SESSION['user_type']=='manager'){
    header('Location:manager_home.php');
}
elseif($_SESSION['user_type']=='driver'){
    header('Location:driver_home.php');
}
else{
session_destroy();
}
}
else{
    $_SESSION['user_type'] = "none";
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fleet Manager Login</title>
    <link rel="stylesheet" type="text/css" href="CSS/styles.css">
    <link rel="stylesheet" type="text/css" href="CSS/unsemantic-grid-responsive-tablet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="js/scripts.js"></script>
</head>
<header>
    <?php require 'templates/nav_bar/index_nav_bar.php';?>
</header>
<body>
<div class="grid-container">
    <div class ="grid-50">
        <img src ="assets/images/Fleet.jpg" alt ="Fleet of cars" height =300px>
    </div>
    <div class = grid-30>
        <div class = form id="login_form">
        <form action="PHP_Scripts/login.php" method = 'post'>
            <h3>Login</h3>
            <label>Email Address:</label> <input type ="text" id="email" name="email"><br><br>
            <label>Password: </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="password" id="password" name="password"><br><br>
            <button type="submit" style="margin-left:180px">Submit</button>
        </form>
    </div>
    </div>
    <div class="grid-20">
    </div>
</div>
<footer>
    Duncan Orr 1809591 CMM007 <a href="about.html">About Fleet Manager</a>
</footer>
</body>

</html>