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
            <div class="collapse navbar-collapse expand" id="navbarTogglerDemo01">
                <a class="navbar-brand me-5" href="#" style="font-size: 28px; font-weight: bold;">Knit-Knot-Nook Admin System</a>
                <ul class="navbar-nav"  style="font-size: 18px;">
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
            </div>
                <div class="d-flex">
                    <a href="logout.php" class="nav-btn">Log out</a>
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
                    <h5 class="modal-title" id="viewModalLabel">REVIEW INFORMATION</h5>
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


    <main class="container pt-3">

        <div class="card" style="margin-top: 130px;">
            <div class="card-header" style="background-color: #fff6f6;">
                <h1 class="text">REVIEWS</h1>
            </div>
            <div class="card-body">
                <table class="table table-bordered" border="3">
                    <thead>
                        <tr class="table-success" style="text-align: center;">
                            <th style="background-color: #ffa6c1;">ReviewID</th>
                            <th style="background-color: #ffc4d6;">Username</th>
                            <th style="background-color: #ffa6c1;">Email</th>
                            <th style="background-color: #ffc4d6;">Comment</th>
                            <th style="background-color: #ffa6c1;">View</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM tblreview";
                        $sql_run = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($sql_run) > 0) {
                            while ($rows = mysqli_fetch_array($sql_run)) {

                        ?>
                                <tr class="table" style="text-align: center;">

                                    <td class="user_id"><?php echo $rows[0]; ?></td>
                                    <td><?php echo $rows[1]; ?></td>
                                    <td><?php echo $rows[2]; ?></td>
                                    <td><?php echo $rows[3]; ?></td>
                                    
                                    
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
                                        .btn_close{
                                            background-color: #e2e7eb;
                                            border: none;
                                            height: 35px;
                                            width: 60px;
                                            border-radius: 5px;
                                            font-size: 18px;
                                        }
                                        .btn_close:hover{
                                            background-color: #B4B8BC;
                                        }
                                     </style>
                                    <!-- button style ends -->
                                    <td>
                                        <button type="button" id="view" class="btn btn-sm view_data">
                                            View
                                        </button>
                                    </td>
                                </tr>
                            <?php }
                        } else {
                            ?>
                            <tr colspan="4">No record/s found</tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <?php echo mysqli_num_rows($sql_run) . " record/s found"; ?>
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
                    url: "r_actions.php",
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


     </script>


    
</body>

</html>