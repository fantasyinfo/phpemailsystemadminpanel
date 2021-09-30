<?php
include 'config.php';
include 'smtp/PHPMailerAutoload.php';

// printing the array in beacutiful mode
function prx($arr)
{
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
}

// getting safe data
function getSafeData($arr)
{
    global $conn;
    htmlentities($arr);
    stripslashes($arr);
    htmlspecialchars($arr);
    return mysqli_real_escape_string($conn, $arr);
}

// function getDate()
// {
//     return date('d, m , Y');
// }


function getName($id)
{
    global $conn;
    $userName =  mysqli_query($conn, "select username from users where id = '{$id}'");
    $filter = mysqli_fetch_assoc($userName);
    echo $filter['username'];
}

function sendMail($to, $subject, $msg)
{
    $mail = new PHPMailer();
    //$mail->SMTPDebug = 3;
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Host = "smtp.gmail.com";
    $mail->Port = "587";
    $mail->IsHTML(true);
    //$mail->addAttachment('sample.pdf');
    $mail->CharSet = 'UTF-8';
    $mail->Username = "fantasyinfo.php@gmail.com";
    $mail->Password = 'Azby1928';
    $mail->SetFrom("fantasyinfo.php@gmail.com", "Email Confirmation");
    $mail->Subject = $subject;
    $mail->Body = $msg;
    $mail->AddAddress($to);
    $mail->SMTPOptions = array('ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => false
    ));
    if (!$mail->Send()) {
        //echo $mail->ErrorInfo;
    } else {
        //echo 'Sent';
    }
}