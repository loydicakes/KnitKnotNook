<?php
session_start();
include 'config.php';
include('lock.php');

//view
if (isset($_POST['click_view_btn'])) {
    $user_id = $_POST['user_id'];

    $sql = "SELECT * FROM tblcart WHERE ProductID='$user_id' ";
    $sql_run = mysqli_query($conn, $sql);
    if (mysqli_num_rows($sql_run) > 0) {
        while ($rows = mysqli_fetch_array($sql_run)) {
            echo '
            <h6>ProductID: ' . $rows[0] . '</h6>
            <h6>Name: ' . $rows[1] . '</h6>
            <h6>Image: ' . $rows[2] . '</h6>
            <h6>Price: ' . $rows[3] . '</h6>
            <h6>Username: ' . $rows[4] . '</h6>
            ';
        }
    } else {
        echo '<h4>No record/s found</h4>';
    }
}
//view


//delete
if (isset($_POST['submit'])) {
    $id = $_POST['xid'];

    //sanitize data
    $stmt = $conn->prepare("DELETE FROM tblcart WHERE ProductID=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt)
        header("Location: cart_admin.php");
    else
        echo mysqli_error($conn) . " ERROR";
}
//delete
?>