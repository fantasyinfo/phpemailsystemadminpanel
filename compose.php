<?php
include 'config.php';
include 'functions.php';
include 'header.php';
?>

<h1>
    Compose Box
</h1>

<form id="ComposeFrm">
    <table>
        <tr>
            <td>Sender : </td>
            <td>
                <select name="sender" id="sender_id">
                    <?php
                    $selectData = mysqli_query($conn, "select username, id from users");
                    if (mysqli_num_rows($selectData) > 0) {
                        while ($row = mysqli_fetch_assoc($selectData)) {
                            $value = $row['id'];
                            $show = $row['username'];
                            echo  "<option value='" . $value . "'>$show</option>";
                        }
                    }
                    ?>
                </select>
            </td>

        </tr>
        <tr>

            <td>
                Messege :
            </td>
            <td>
                <textarea name="msg_to_send" id="msg" cols="30" rows="10"></textarea>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="hidden" name="compose" value="rcompose">
                <input type="submit" value="submit" name="submit">
            </td>
        </tr>
        <div id="Msg" class="alert alert-success msg">
            Mail Has Been Send Successfully;
        </div>
    </table>
</form>
<?php include 'footer.php'; ?>