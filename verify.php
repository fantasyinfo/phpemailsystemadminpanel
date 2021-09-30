<?php
include 'config.php';
include 'functions.php';
if (isset($_GET['id'])) {
    $id = getSafeData($_GET['id']);
    $sql = "update users set status = 1 where id = '{$id}'";

    if ($insertQuery = mysqli_query($conn, $sql)) {

        echo "Verified Successfully";
        sleep(2);
        header("location: login.php");
    }
}