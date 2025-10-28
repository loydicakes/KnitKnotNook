<?php
session_start();
include 'config.php';
include('lock.php');

//add
if (isset($_POST['add_user'])) {
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];
    $AccessLevel = $_POST['AccessLevel'];

    $insert_query = $conn->prepare("INSERT INTO tbluser(Username,Password,AccessLevel) VALUES(?,?,?)");
    $insert_query->bind_param("sss", $Username, $Password, $AccessLevel);
    $insert_query->execute();

    //UPLOAD
    move_uploaded_file($tempname, $folder);
    if ($insert_query) {
        $_SESSION['status'] = "Data inserted successfully";
        header('location: user_admin.php');
    } else {
        $_SESSION['status'] = "Data insertion failed";
        header('location: user_admin.php');
    }
}
//add

//view
if (isset($_POST['click_view_btn'])) {
    $user_id = $_POST['user_id'];

    $sql = "SELECT * FROM tbluser WHERE UserID='$user_id' ";
    $sql_run = mysqli_query($conn, $sql);
    if (mysqli_num_rows($sql_run) > 0) {
        while ($rows = mysqli_fetch_array($sql_run)) {
            echo '
            <h6>UserID: ' . $rows[0] . '</h6>
            <h6>Username: ' . $rows[1] . '</h6>
            <h6>Password: ' . $rows[2] . '</h6>
            <h6>AccessLevel: ' . $rows[3] . '</h6>
            ';
        }
    } else {
        echo '<h4>No record/s found</h4>';
    }
}
//view

//edit

if (isset($_POST['click_edit_btn'])) {
    $user_id = $_POST['user_id'];
    $arrayresult = [];

    $sql = "SELECT * FROM tbluser WHERE UserID='$user_id' ";
    $sql_run = mysqli_query($conn, $sql);
    if (mysqli_num_rows($sql_run) > 0) {
        while ($rows = mysqli_fetch_array($sql_run)) {
            array_push($arrayresult, $rows);
            header('content-type: application/json');
            echo json_encode($arrayresult);
        }
    } else {
        echo '<h4>No record/s found</h4>';
    }
}
// edit

//update
if (isset($_POST['update_user'])) {
    $id = $_POST['id'];
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];
    $AccessLevel = $_POST['AccessLevel'];

    $update_query = "UPDATE tbluser SET Username='$Username',Password='$Password',AccessLevel='$AccessLevel' WHERE UserID='$id'";
    $update_query_run = mysqli_query($conn, $update_query);

    if ($update_query_run) {
        $_SESSION['status'] = "Data updated successfully";
        header('location: user_admin.php');
    } else {
        $_SESSION['status'] = "Updating data failed";
        header('location: user_admin.php');
    }
}
//update

//delete
if (isset($_POST['submit'])) {
    $id = $_POST['xid'];

    //sanitize data
    $stmt = $conn->prepare("DELETE FROM tbluser WHERE UserID=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt)
        header("Location: user_admin.php");
    else
        echo mysqli_error($conn) . " ERROR";
}
//delete
?>