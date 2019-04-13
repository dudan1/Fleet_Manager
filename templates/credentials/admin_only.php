<?php
session_start();
if($_SESSION['user_type'] != 'admin'){
    session_destroy();
    header('Location:index.php');
}

?>