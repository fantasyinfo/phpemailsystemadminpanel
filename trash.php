<?php
session_start();
include 'config.php';
include 'functions.php';
include 'header.php';
if (!isset($_SESSION['USERNAME'])) {
    header("location: login.php");
}
$sql = "select * from messege where to_id = '{$_SESSION['ID']}' AND to_status = 2";
$inboxQuery = mysqli_query($conn, $sql);



?>

<h1>
    Trash Box
</h1>


<div class="container">
    <div class="row d-flex my-5 shadow-5 justify-content-center align-items-center">

        <div class="col-md-8">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">From</th>
                        <th scope="col">Restore</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($inboxQuery) > 0) {

                        while ($row = mysqli_fetch_assoc($inboxQuery)) { ?>
                    <tr id="<?php echo "trash_msg_id_" . $row['id']; ?>">
                        <th scope="row"><?= $row['id']; ?></th>
                        <td><?php getName($row['from_id']); ?></td>
                        <td> <button class="btn btn-success"
                                onclick="restore_inbox_delete_msg(<?= $row['id']; ?> )">Restore
                            </button></td>
                        <td>
                            <button class="btn btn-danger"
                                onclick="inbox_trash_delete_msg(<?= $row['id']; ?> )">Permanent Delete
                            </button>
                        </td>
                    </tr>
                    <?php    }
                    }

                    ?>


                </tbody>
            </table>

        </div>

    </div>
</div>

<?php
include 'footer.php' ?>