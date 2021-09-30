<?php
session_start();
if (isset($_SESSION)) {
    unset($_SESSION['USERNAME']);
    unset($_SESSION['USEREMAIL']);
    unset($_SESSION['ID']);
    header("location: login.php");
    die();
} else {
    header("location: login.php");
}