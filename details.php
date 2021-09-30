<?php
session_start();
include 'config.php';
include 'functions.php';
include 'header.php';
if (isset($_GET['id'])) {
    $id = getSafeData($_GET['id']);
    $from_id = $_SESSION['ID'];
    $sql = "select messege from messege where id = '{$id}' AND from_id = '{$from_id}'";
    $detailedMsg = mysqli_query($conn, $sql);
    $filterData =  mysqli_fetch_assoc($detailedMsg);
}
?>

<h1>
    Details Page
</h1>
<div class="container">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-8 my-5">
            <p class="shadow card">
                <?= $filterData['messege']; ?>
            </p>
        </div>
    </div>
</div>

<?php
include 'footer.php' ?>