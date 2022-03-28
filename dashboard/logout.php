
<?php
session_start(); //if session has login data, we destroy session and redirect user to login page
if(isset($_SESSION)){
    session_destroy();
    header('location:../login.php');
    exit();
}
?>