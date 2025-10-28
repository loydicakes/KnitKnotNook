<?php
session_start();
include('config.php');
include('lock.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin System</title>
    <link rel="stylesheet" href="Assets/bootstrap-5.3.3-dist/css/bootstrap.css">
    <script src="Assets/bootstrap-5.3.3-dist/js/bootstrap.js"></script>
    <script src="Assets/jquery-3.7.1.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand fixed-top" style="background-color: rgb(253, 177, 202);">
        <div class="container-fluid" style="margin-top: 10px; margin-bottom: 10px;">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-laber="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="navbar-brand me-5" href="#" style="font-size: 28px; font-weight: bold;">Knit-Knot-Nook Admin System</a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0"  style="font-size: 18px;">
                    <li class="nav-item me-5">
                        <a class="nav-link" active-current="page" href="user_admin.php">USER</a>
                    </li>
                    <li class="nav-item me-5">
                        <a class="nav-link" active-current="page" href="item_admin.php">ITEM</a>
                    </li>
                    <li class="nav-item me-5">
                        <a class="nav-link" active-current="page" href="cart_admin.php">CART</a>
                    </li>
                    <li class="nav-item me-5">
                        <a class="nav-link" active-current="page" href="ship_admin.php">SHIP</a>
                    </li>
                    <li class="nav-item me-5">
                        <a class="nav-link" active-current="page" href="review_admin.php">REVIEW</a>
                    </li>
                    <li class="nav-item me-5">
                        <a class="nav-link" active-current="page" href="dash_admin.php">DASHBOARD</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a href="logout.php" class="nav-btn">Log out</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- modal style starts -->
    <style>
        html{
            overflow-y: scroll;
            font-family: Tahoma;
        }
         .nav-btn {
            font-size: 17px;
            color: #212832;
            font-weight: 500;
            border: 2px solid #212832;
            padding: 5px 15px;
            border-radius: 5px;
            margin-right: 20px;
            transition: all .3s;
            text-decoration: none;
            margin-right: 230px;
        }
        .nav-btn:hover {
            background-color: black;
            color: white;
        }
        .form-control:hover{
            background-color: #e2e7eb;
        }
        .modal-title{
            font-weight: bold;
            font-size: 20px;
        }
        .form-group, .form-label, .modal-body {
            font-style: Tahoma;
        }
        .modal-content{
            font-weight:bold;
            font-size: 16px;
            font-style: Tahoma;
        }
        .navbar-nav .nav-item .nav-link {
         border-bottom: 2px solid transparent;
        transition: all 0.3s;
        }

        .navbar-nav .nav-item .nav-link:hover {
        border-bottom: 2px solid black; 
        }
     </style>
     <!-- modal style ends -->
    <!--View Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">ITEM INFORMATION</h5>
                </div>
                <div class="modal-body">
                    <div class="view_user_data">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn_close" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!--View Modal -->

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">DELETE ITEM IN CART</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this item?
                </div>
                <div class="modal-footer">
                    <form action="c_actions.php" method="POST">
                        <input type="hidden" id="delid" name="xid">
                        <button type="submit" name="submit" class="btn_yes">Yes</button>
                        <button type="button" class="btn_no" data-bs-dismiss="modal">No</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Modal -->
    <main class="container pt-3">

        <div class="card" style="margin-top: 130px;">
            <div class="card-header" style="background-color: #fff6f6;">
                <h1 class="text">REPORTS</h1>
            </div>
            <div class="card-body">
                <table class="table table-bordered" border="3">
                    <thead>
                        <tr style="text-align: center;">
                            <th style="background-color: #ffa6c1;">Number of accounts</th>
                            <th style="background-color: #ffc4d6;">Total number of items</th>
                            <th style="background-color: #ffa6c1;">Pending orders</th>
                            <th style="background-color: #ffc4d6;">Number of reviews</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $user = "SELECT * FROM tbluser";
                        $user_run = mysqli_query($conn, $user);
                        $item = "SELECT * FROM tblflower";
                        $item_run = mysqli_query($conn, $item);
                        $order = "SELECT * FROM tblship";
                        $order_run = mysqli_query($conn, $order);
                        $review = "SELECT * FROM tblreview";
                        $review_run = mysqli_query($conn, $review);
                        if (mysqli_num_rows($user_run) > 0) {
                        ?>
                                <tr class="table" style="text-align: center;">

                                    <td><?php echo mysqli_num_rows($user_run); ?></td>
                                    <td><?php echo mysqli_num_rows($item_run); ?></td>
                                    <td><?php echo mysqli_num_rows($order_run); ?></td>
                                    <td><?php echo mysqli_num_rows($review_run); ?></td>


                                    <!-- EDIT DATA -->
                                     <!-- button style starts -->
                                    <style>
                                        .text{
                                            font-size: 40px;
                                            margin-bottom: 20px;
                                            margin-top: 20px
                                        }
                                        #view{
                                            background-color: black;
                                            color: white;
                                            border: none;
                                            height: 35px;
                                            width: 50px;
                                            border-radius: 5px;
                                            font-size: 15px;

                                        }
                                        #view:hover{
                                            background-color: #484547;
                                        } 
                                        .btn_close, .btn_no{
                                            background-color: #e2e7eb;
                                            border: none;
                                            height: 35px;
                                            width: 60px;
                                            border-radius: 5px;
                                            font-size: 18px;
                                        }
                                        .btn_no:hover, .btn_close:hover{
                                            background-color: #595959;
                                        }
                                        #delete{
                                            background-color: #ff87ab;
                                            border: none;
                                            height: 35px;
                                            width: 60px;
                                            border-radius: 5px;
                                            color: white;
                                            
                                        }
                                        #delete:hover, .btn_yes:hover{
                                            background-color: #ff5d8f;
                                        }
                                        .btn_yes{
                                            background-color: #ff87ab;
                                            border: none;
                                            height: 35px;
                                            width: 80px;
                                            border-radius: 5px;
                                            font-size: 18px;
                                            color: white;
                                        }
                                    </style>
                                      <!-- button style ends -->

                                </tr>
                            <?php 
                        } else {
                            ?>
                            <tr colspan="4">No record/s found</tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <?php
            if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
            ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Hey! </strong> <?php echo $_SESSION['status']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
                unset($_SESSION['status']);
            }
            ?>
    </main>

    <script>
        //View
        $(document).ready(function() {

            $('.view_data').click(function(e) {
                e.preventDefault();
                var user_id = $(this).closest('tr').find('.user_id').text();

                $.ajax({
                    method: "POST",
                    url: "c_actions.php",
                    data: {
                        'click_view_btn': true,
                        'user_id': user_id,
                    },
                    success: function(response) {

                        $('.view_user_data').html(response);
                        $('#viewModal').modal('show');
                    }
                });

            });
        });
        //View

        //Edit
        $(document).ready(function() {

            $('.edit_data').click(function(e) {
                e.preventDefault();
                var user_id = $(this).closest('tr').find('.user_id').text();
                console.log(user_id);

                $.ajax({
                    method: "POST",
                    url: "c_actions.php",
                    data: {
                        'click_edit_btn': true,
                        'user_id': user_id,
                    },
                    success: function(response) {
                        // console.log(response);
                        $.each(response, function(Key, value) {
                            $('#user_id').val(value[0]);
                            $('#Username').val(value[1]);
                            $('#Password').val(value[2]);
                            $('#AccessLevel').val(value[3]);
                        });
                        $('#editModal').modal('show');
                    }
                });

            });
        });

        //Edit
        //Delete
        function deletexid(x) {
            document.getElementById('delid').value = x;
        }
        //Delete
    </script>

</body>

</html>