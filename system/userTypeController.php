<?php
@session_start(); //this file contains helper functions to verify authorization
function isadmin() { //if user type is 3, then it is admin and etc.

    if(isset($_SESSION['id'])){

        return $_SESSION['user_type'] == '3';
    }
    return false;
}

function isemployer() {
    if(isset($_SESSION['id'])){
        return $_SESSION['user_type'] == '2';
    }
    return false;
}

function isfreelancer() {
    if(isset($_SESSION['id'])){
        return $_SESSION['user_type'] == '1';
    }
    return false;

}

?>