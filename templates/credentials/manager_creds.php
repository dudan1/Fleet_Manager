<?php
session_start();
if($_SESSION['user_type'] != 'admin' AND $_SESSION['user_type'] != 'manager'){
    session_destroy();
    header('Location:index.php');
}