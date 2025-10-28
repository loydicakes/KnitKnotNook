<?php
session_start();
include ('config.php');
include('lock.php');

//add
if (isset($_POST['add_user'])) {
    $filename=$_FILES['Item_image']['name'];
    $tempname=$_FILES['Item_image']['tmp_name'];
    $folder= "image/".$filename;

    $Name = $_POST['Item_name'];
    $Price = $_POST['Item_price'];
    $Description = $_POST['Item_description'];
    $Category = $_POST['Item_category'];
    $Quantity = $_POST['Current_quantity'];

    $insert_query = $conn->prepare("INSERT INTO tblflower(Item_name,Item_price,Item_description,Item_image, Item_category, Current_quantity) VALUES(?,?,?,?,?,?)");
    $insert_query->bind_param("sisssi", $Name, $Price, $Description, $folder, $Category, $Quantity);
    $insert_query->execute();

    //UPLOAD
    move_uploaded_file($tempname, $folder);
    if ($insert_query) {
        $_SESSION['status'] = "Data inserted successfully";
        header('location: item_admin.php');
    } else {
        $_SESSION['status'] = "Data insertion failed";
        header('location: item_admin.php');
    }
}
//add

//view
if (isset($_POST['click_view_btn'])) {
    $user_id = $_POST['user_id'];

    $sql = "SELECT * FROM tblflower WHERE ProductID='$user_id' ";
    $sql_run = mysqli_query($conn, $sql);
    if (mysqli_num_rows($sql_run) > 0) {
        while ($rows = mysqli_fetch_array($sql_run)) {
            echo '
            <h6>ProductID: ' . $rows[0] . '</h6>
            <h6>Item Name: ' . $rows[1] . '</h6>
            <h6>Item Price: ' . $rows[2] . '</h6>
            <h6>Item Image: ' . $rows[3] . '</h6>
            <h6>Item Description: ' . $rows[4] . '</h6>
            <h6>Item Category: ' . $rows[5] . '</h6>
            <h6>Current Quantity: ' . $rows[6] . '</h6>
            ';
        }
    } else {
        echo '<h4>No record/s found</h4>';
    }
}

//view

// edit

if (isset($_POST['click_edit_btn'])) {
    $user_id = $_POST['user_id'];
    $arrayresult = [];

    $sql = "SELECT * FROM tblflower WHERE ProductID='$user_id' ";
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

//edit

//update
if (isset($_POST['update_user'])) {
    $filename=$_FILES['Item_image']['name'];
    $tempname=$_FILES['Item_image']['tmp_name'];
    $folder= "image/".$filename;

    $id = $_POST['id'];
    $Name = $_POST['Item_name'];
    $Price = $_POST['Item_price'];
    $Description = $_POST['Item_description'];
    $Category = $_POST['Item_category'];
    $Quantity = $_POST['Current_quantity'];

    $update_query = "UPDATE tblflower SET `Item_name`= '$Name',`Item_price`='$Price',`Item_image`='$folder',`Item_description`='$Description',`Item_category`='$Category', `Current_quantity`='$Quantity' WHERE ProductID= '$id'";
    $update_query_run = mysqli_query($conn, $update_query);

    //UPLOAD
    move_uploaded_file($tempname, $folder);
    if ($update_query_run) {
        $_SESSION['status'] = "Data updated successfully";
        header('location: item_admin.php');
    } else {
        $_SESSION['status'] = "Updating data failed";
        header('location: item_admin.php');
    }
}
//update

//delete
if (isset($_POST['submit'])) {
    $id = $_POST['xid'];

    //sanitize data
    $stmt = $conn->prepare("DELETE FROM tblflower WHERE ProductID=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt)
        header("Location: item_admin.php");
    else
        echo mysqli_error($conn) . " ERROR";
}
//delete
?>