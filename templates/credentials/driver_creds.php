<?php
session_start();
if($_SESSION['user_type'] != 'admin' AND $_SESSION['user_type'] != 'driver'){
    session_destroy();
    header('Location:index.php');
}
?>