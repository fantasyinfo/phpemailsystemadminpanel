<?php
include 'config.php';
include 'functions.php';

session_start();

$msg = "";
$status = "";


// register
if (isset($_POST['register'])) {
    $userName = getSafeData($_POST['username']);
    $userEmail = getSafeData($_POST['email_id']);
    $userPassword = getSafeData($_POST['password']);
    $userPassword = md5($userPassword);
    $statusInsert = 0;
    $rand_no = rand(111111111, 999999999);
    $createdOn = date('d, m , Y');
    if ($userEmail == '') {
        $status = 303;
        $msg = "Please Enter Valid Email Id";
        $error = true;
    }
    $userEmailSearch = mysqli_query($conn, "select * from users where email_id = '{$userEmail}'");
    if ($userEmailSearch) {
        if (mysqli_num_rows($userEmailSearch) > 0) {
            $status = 304;
            $msg = "Email Already Exists";
            $error = true;
        }
    }

    $userNameSearch = mysqli_query($conn, "select * from users where username = '{$userName}'");
    if ($userNameSearch) {
        if (mysqli_num_rows($userNameSearch) > 0) {
            $status = 404;
            $msg = "Username Already Exists";
            $error = true;
        }
    }


    if ($error != true && isset($_POST['email_id']) && !empty($_POST['email_id'])) {
        $sql = "insert into users (username, email_id, password, status, rand_no, created_on ) values ('{$userName}','{$userEmail}','{$userPassword}','{$statusInsert}', '{$rand_no}',now())";

        $insertQuery = mysqli_query($conn, $sql);
        if ($insertQuery) {
            $_SESSION['RID'] = mysqli_insert_id($conn);
            $status = 200;
            $msg = "Your Data Inserted Succefully ";
            $userInsertId = mysqli_insert_id($conn);
            $subject = "OTP For Registration On Our Site";
            $msg_mail = "<h1>Hi, $userName </h1> Here is your OTP code for Complete Registration.";
            $msg_mail .= "</br></br></br>";
            $msg_mail .= "<h1>" . $rand_no . "</h1>";
            sendMail($userEmail, $subject, $msg_mail);
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

// enter otp
if (isset($_POST['otp'])) {
    $otp = getSafeData($_POST['otp']);
    $id = $_SESSION['RID'];
    $selectSql = "select * from users where rand_no = '{$otp}'";
    if (mysqli_query($conn, $selectSql)) {
        $update = mysqli_query($conn, "update users set status = 1 where id = $id");
        if ($update) {
            $error = false;
            $status = 200;
        }
    } else {
        $error = true;
        $status = 404;
        //echo "otp did not mathced";
    }
    $data = [
        'status' => $status,
        'error_code' => $error
    ];
    echo json_encode($data);
}

// login
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
// compose
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

// delete inbox to trash
if (isset($_POST['inbox_id'])) {
    $updateSql = "update messege set to_status = 2 where id = '" . $_POST['inbox_id'] . "'";
    if (mysqli_query($conn, $updateSql)) {
        $status = 200;
        $msg = "Data Deleted Succefully";
    } else {
        $status = 404;
        $msg = "Data Did Not Deleted";
    }

    $data = [
        'status' => $status,
        'msg' => $msg

    ];
    echo json_encode($data);
}
// delete inbox msg from trash to permanently
if (isset($_POST['trash_del_id'])) {
    $updateSql = "update messege set to_status = 3 where id = '" . $_POST['trash_del_id'] . "'";
    if (mysqli_query($conn, $updateSql)) {
        $status = 200;
        $msg = "Data Deleted Succefully";
    } else {
        $status = 404;
        $msg = "Data Did Not Deleted";
    }

    $data = [
        'status' => $status,
        'msg' => $msg

    ];
    echo json_encode($data);
}

// restore inbox msg from trash to inbox again

if (isset($_POST['trash_res_id'])) {
    $updateSql = "update messege set to_status = 1 where id = '" . $_POST['trash_res_id'] . "'";
    if (mysqli_query($conn, $updateSql)) {
        $status = 200;
        $msg = "Data Restored";
    } else {
        $status = 404;
        $msg = "Data Did Not Deleted";
    }

    $data = [
        'status' => $status,
        'msg' => $msg

    ];
    echo json_encode($data);
}
// delete sendx to trash
if (isset($_POST['send_id'])) {
    $updateSql = "update messege set from_status = 2 where id = '" . $_POST['send_id'] . "'";
    if (mysqli_query($conn, $updateSql)) {
        $status = 200;
        $msg = "Data Deleted Succefully";
    } else {
        $status = 404;
        $msg = "Data Did Not Deleted";
    }

    $data = [
        'status' => $status,
        'msg' => $msg

    ];
    echo json_encode($data);
}