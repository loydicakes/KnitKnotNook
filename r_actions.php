<?php
session_start();
include 'config.php';
include('lock.php');
//view
if (isset($_POST['click_view_btn'])) {
    $user_id = $_POST['user_id'];

    $sql = "SELECT * FROM tblreview WHERE ReviewID='$user_id' ";
    $sql_run = mysqli_query($conn, $sql);
    if (mysqli_num_rows($sql_run) > 0) {
        while ($rows = mysqli_fetch_array($sql_run)) {
            echo '
            <h6>ReviewID: ' . $rows[0] . '</h6>
            <h6>Username: ' . $rows[1] . '</h6>
            <h6>Email: ' . $rows[2] . '</h6>
            <h6>Comment: ' . $rows[3] . '</h6>
            ';
        }
    } else {
        echo '<h4>No record/s found</h4>';
    }
}
//view

?>