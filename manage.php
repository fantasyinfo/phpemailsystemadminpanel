<?php
include 'config.php';
include 'functions.php';

session_start();

$msg = "";
$status = "";



if (isset($_POST['register'])) {
    $userName = getSafeData($_POST['username']);
    $userEmail = getSafeData($_POST['email_id']);
    $userPassword = getSafeData($_POST['password']);
    $userPassword = md5($userPassword);
    $statusInsert = 0;
    $createdOn = date('d, m , Y');
    if ($userEmail == '') {
        $status = 303;
        $msg = "Please Enter Valid Email Id";
        $error = true;
    }
    $userNameSearch = mysqli_query($conn, "select username from users where username = '{$userName}'");
    if ($userNameSearch) {
        if (mysqli_num_rows($userNameSearch) > 0) {
            $status = 404;
            $msg = "Username Already Exists";
            $error = true;
        }
    }
    if ($error != true && isset($_POST['email_id']) && !empty($_POST['email_id'])) {
        $sql = "insert into users (username, email_id, password, status, created_on ) values ('{$userName}','{$userEmail}','{$userPassword}','{$statusInsert}', now())";

        $insertQuery = mysqli_query($conn, $sql);
        if ($insertQuery) {
            $status = 200;
            $msg = "Your Data Inserted Succefully ";
            $userInsertId = mysqli_insert_id($conn);
            $subject = "Please Click on Verify Link to Verify Your Email Id for Login to Our Site";
            $msg = "<h1>Hi, $userName </h1> Please Click On Below Link To Veify Your Email Id With us to Login Succesfully";
            $msg .= "</br>";
            $msg .= "http://localhost/gmailsystem/verify.php?id=$userInsertId";
            sendMail($userEmail, $subject, $msg);
            $error = false;
        }
    }
    $data = [
        'status' => $status,
        'msg' => $msg,
        'error_code' => $error
    ];
    echo json_encode($data);
}


if (isset($_POST['login'])) {
    $userName = getSafeData($_POST['username']);
    $userPassword = getSafeData($_POST['password']);
    $userPassword = md5($userPassword);

    if ($userName == '') {
        $status = 303;
        $msg = "Please Enter a Valid Email Id or Username";
        $error = true;
    }
    if ($userPassword == '') {
        $status = 304;
        $msg = "Please Enter a Password";
        $error = true;
    }

    if ($error != true && isset($_POST['username']) && !empty($_POST['username'])) {
        $sql = "select * from users where (username = '{$userName}' or email_id = '{$userName}') AND password = '{$userPassword}' AND status = 1";


        $selectQuery = mysqli_query($conn, $sql);
        if ($selectQuery) {
            if (mysqli_num_rows($selectQuery) == 1) {
                $data =  mysqli_fetch_assoc($selectQuery);
                $_SESSION['USERNAME'] = $data['username'];
                $_SESSION['USEREMAIL'] = $data['email_id'];
                $_SESSION['ID'] = $data['id'];
                $status = 200;
                $msg = "Login Successfully";
                $error = false;
            } else {
                $status = 305;
                $msg = "Password Did Not Mathced";
                $error = true;
            }
        } else {
            $status = 305;
            $msg = "Password Did Not Mathced";
            $error = true;
        }
    } else {
        $status = 305;
        $msg = "Please Click on the link which is already sent you email id to verify then login";
        $error = true;
    }

    $data = [
        'status' => $status,
        'msg' => $msg,
        'error_code' => $error
    ];
    echo json_encode($data);
}

if (isset($_POST['compose'])) {
    $sendUserId = getSafeData($_POST['sender']);
    $sendMessege = getSafeData($_POST['msg_to_send']);
    $from_status = $to_status = $status_msg = 1;
    if ($sendUserId == '') {
        $status = 303;
        $msg = "Please Select a Valid User To Send Messege";
        $error = true;
    }
    if ($sendMessege == '') {
        $status = 304;
        $msg = "Please Enter a Messege";
        $error = true;
    }

    if ($error != true && isset($_POST['sender']) && !empty($_POST['msg_to_send'])) {
        $sql = "insert into messege (user_id, messege, from_id, to_id, from_status, to_status, status, created_on) values ('{$_SESSION['ID']}','{$sendMessege}','{$_SESSION['ID']}','{$sendUserId}','{$from_status}','{$to_status}','{$status_msg}',now())";

        $insertQuery = mysqli_query($conn, $sql);
        if ($insertQuery) {

            $status = 200;
            $msg = "Mail Send Successfully";
            $error = false;
        } else {
            $status = 305;
            $msg = "Mailed Did Not Send Due To a Error";
            $error = true;
        }
    }

    $data = [
        'status' => $status,
        'msg' => $msg,
        'error_code' => $error
    ];
    echo json_encode($data);
}