<?php
include 'config.php';
include 'functions.php';
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $id = getSafeData($_GET['id']);

    $selectSql = "select * from users where rand_no = '{$id}'";
    if ($result = mysqli_query($conn, $selectSql)) {
        if (mysqli_num_rows($result) > 0) {
            $filterData =  mysqli_fetch_assoc($result);
            $userId = $filterData['id'];
            $userStatus = $filterData['status'];
            if ($userStatus == 0) {
                $sql = "update users set status = 1 where id = '{$userId}'";
                if ($insertQuery = mysqli_query($conn, $sql)) {
                    echo "Verified Successfully Redirect You in Seconds";

?>
<script>
setTimeout(window.location.href = "login.php", 30000);
</script>
<?php
                }
            } else {
                header("location: login.php");
            }
        } else {
            header("location: register.php");
        }
    } else {
        header("location: register.php");
    }
}