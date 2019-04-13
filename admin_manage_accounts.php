
<?php
require 'templates/credentials/admin_only.php';

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage User Accounts</title>
    <link rel="stylesheet" type="text/css" href="CSS/styles.css">
    <link rel="stylesheet" type="text/css" href="CSS/unsemantic-grid-responsive-tablet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="js/scripts.js"></script>
</head>
<header>
    <?php require 'templates/nav_bar/admin_nav_bar.php';?>
</header>
<body>
<div class="grid-container">
    <div class="grid-100">
        <div id="details" class="details_form" style="margin-top:100px">
            <form  action="PHP_Scripts/admin_add_user.php" method="post">
                <h1>Add a new User</h1>
                <p>Add a new user below. Ensure all details are correct</p>
                <p>Email Address: <input type="text" required name="email" maxlength="50"></p>
                <p>Password: <input type="password" required name="password1" maxlength="20"></p>
                <p>Repeat Password: <input type="password" required name="password2" maxlength="20"></p>
                <p>User Type: <select name="user_type">
                        <option name="driver">driver</option>
                        <option name="manager">manager</option>
                    </select></p>
                <button type="submit">Create New User</button>
            </form>
        </div>
    </div>
</div>
<footer>
    Duncan Orr 1809591 CMM007 <a href="about.html">About Fleet Manager</a>
</footer>
</body>
</html>