<?php
session_start();
include 'config.php';
include 'functions.php';
include 'header.php';
if (!isset($_SESSION['USERNAME'])) {
    header("location: login.php");
}
echo $sql = "select * from messege where from_id = '{$_SESSION['ID']}' AND from_status = 1";
$inboxQuery = mysqli_query($conn, $sql);



?>

<h1>
    Send Box
</h1>

<div class="container">
    <div class="row d-flex my-5 shadow-5 justify-content-center align-items-center">

        <div class="col-md-8">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">To</th>
                        <th scope="col">Messege</th>
                        <th scope="col">Date</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($inboxQuery) > 0) {

                        while ($row = mysqli_fetch_assoc($inboxQuery)) { ?>
                    <tr id="<?php echo "send_msg_id_" . $row['id']; ?>">
                        <th scope="row"><?= $row['id']; ?></th>
                        <td><?php getName($row['from_id']); ?></td>
                        <td><a class="text-black"
                                href="details.php?id_send=<?= $row['id']; ?>"><?php echo substr($row['messege'], 0, 15); ?>
                        </td>
                        <td><?= $row['created_on']; ?></td>
                        <td>
                            <button class="btn btn-danger"
                                onclick="send_delete_msg(<?= $row['id']; ?> )">Delete</button>
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