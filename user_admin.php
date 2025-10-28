<?php
session_start();
include ('config.php');
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
   
    <nav class="navbar navbar-expand-lg fixed-top" style="background-color: rgb(253, 177, 202);">
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
        .form-control:hover {
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
        #message{
            background-color: #e2e7eb;
        }
        .navbar-nav .nav-item .nav-link {
         border-bottom: 2px solid transparent;
        transition: all 0.3s;
        }

        .navbar-nav .nav-item .nav-link:hover {
        border-bottom: 2px solid black; /* Change to your desired color */
        }
    </style>
<!-- modal style ends -->

    <!-- AddModal -->
    <div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">ADD USER</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="u_actions.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" name="Username" class="form-control" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="Password" class="form-control" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label for="">Select AccessLevel</label>
                            <select class="form-control" name="AccessLevel" id="AccessLevel" required>
                                <option value="">---</option>
                                <option value="User">User</option>
                                <option value="Admin">Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn_close" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="add_user" class="btn_save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- AddModal -->

    <!--View Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">USER INFORMATION</h5>
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

    <!-- EditModal -->
    <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">EDIT USER INFORMATION</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="u_actions.php" method="POST"  enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="id" id="user_id" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="">Edit Username</label>
                            <input type="text" name="Username" id="Username" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="Password">Edit Password</label>
                            <input type="password" name="Password" id="Password" class="form-control" placeholder="">
                            <input type="checkbox" id="togglePassword"> Show Password
                        </div>

                        <div class="form-group">
                        <label for="">Select AccessLevel</label>
                        <select class="form-control" name="AccessLevel" id="AccessLevel" required>
                            <option value="">---</option>
                            <option value="User">User</option>
                            <option value="Admin">Admin</option>
                        </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn_close" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="update_user" class="btn_update">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- EditModal -->

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">DELETE USER</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this user?
                </div>
                <div class="modal-footer">
                    <form action="u_actions.php" method="POST">
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
                <h1 class="text">LISTS OF USERS</h1>
                <!-- Button trigger modal -->
                <button type="button" class="add" data-bs-toggle="modal" data-bs-target="#addModal">
                    ADD USER
                </button>
            </div>
            <div class="card-body">
                <table class="table table-bordered" border="3">
                    <thead>
                        <tr style="text-align: center;">
                            <th style="background-color: #ffa6c1;">UserID</th>
                            <th style="background-color: #ffc4d6;">Username</th>
                            <th style="background-color: #ffa6c1;">Password</th>
                            <th style="background-color: #ffc4d6;">AccessLevel</th>
                            <th style="background-color: #ffa6c1;">View</th>
                            <th style="background-color: #ffc4d6;">Edit</th>
                            <th style="background-color: #ffa6c1;">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM tbluser";
                        $sql_run = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($sql_run) > 0) {
                            while ($rows = mysqli_fetch_array($sql_run)) {

                                ?>
                                                <tr class="table" style="text-align: center;">

                                                    <td class="user_id"><?php echo $rows[0]; ?></td>
                                                    <td><?php echo $rows[1]; ?></td>
                                                    <td><?php echo str_repeat('*', strlen($rows[2])); ?></td>
                                                    <td><?php echo $rows[3]; ?></td>
                                    
                                                    <!-- EDIT DATA -->
                                                    <!-- button style starts -->
                                                     <style>
                                                        .text{
                                                            font-size: 40px;
                                                            margin-bottom: 20px;
                                                        }
                                                        .add{
                                                            background-color: #ff87ab;
                                                            border: none;
                                                            height: 40px;
                                                            width: 130px;
                                                            font-size: 18px;
                                                            border-radius: 5px;
                                                            font-weight: 100px;
                                                            color: white;
                                                            margin-bottom: 10px;
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
                                                        #edit{
                                                            background-color: dimgrey;
                                                            border: none;
                                                            height: 35px;
                                                            width: 50px;
                                                            border-radius: 5px;
                                                            color: white;
                                                        }
                                                        #edit:hover, .btn_no:hover, .btn_close:hover{
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
                                                        .btn_close, .btn_no{
                                                            background-color:dimgrey;
                                                            border: none;
                                                            height: 35px;
                                                            width: 60px;
                                                            border-radius: 5px;
                                                            font-size: 18px;
                                                            color: white;
                                                        }
                                                        .btn_update, .btn_yes, .btn_save{
                                                            background-color: #ff87ab;
                                                            border: none;
                                                            height: 35px;
                                                            width: 80px;
                                                            border-radius: 5px;
                                                            font-size: 18px;
                                                            color: white;
                                                        }
                                                        .add:hover, #delete:hover, .btn_yes:hover, .btn_yes:hover, .btn_save:hover, .btn_update:hover{
                                                            background-color: #c27580;
                                                        }
                                                    </style>
                                                    <!-- button style ends -->

                                                    <td>
                                                        <button type="button" id="view" class="btn btn-sm view_data">
                                                            View
                                                        </button>
                                                    </td>
                                                    <td>
                                                        <button type="button" id="edit" class="btn btn-sm edit_data">
                                                            Edit
                                                        </button>
                                                    </td>
                                                    <td>
                                                        <button type="button" id="delete" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="deletexid(<?= $rows[0]; ?>);" class="btn btn-sm delete_data">
                                                            Delete
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
                        <div id="message" class="alert alert-dismissible fade show" role="alert">
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
                    url: "u_actions.php",
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

        document.getElementById('togglePassword').addEventListener('change', function (e) {
        const passwordInput = document.getElementById('Password');
        if (e.target.checked) {
            passwordInput.type = 'text';
        } else {
            passwordInput.type = 'password';
        }
        });

    // Existing Edit script
    $(document).ready(function() {
        $('.edit_data').click(function(e) {
            e.preventDefault();
            var user_id = $(this).closest('tr').find('.user_id').text();
            console.log(user_id);

            $.ajax({
                method: "POST",
                url: "u_actions.php",
                data: {
                    'click_edit_btn': true,
                    'user_id': user_id,
                },
                success: function(response) {
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


        /*$(document).ready(function() {

            $('.edit_data').click(function(e) {
                e.preventDefault();
                var user_id = $(this).closest('tr').find('.user_id').text();
                console.log(user_id);

                $.ajax({
                    method: "POST",
                    url: "u_actions.php",
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
        });*/

        //Edit
        //Delete
        function deletexid(x) {
            document.getElementById('delid').value = x;
        }
        //Delete
    </script>

    <script>
        //GET USER DETAILS
        function getUserDetails(uid, uname, upass, access){
            Console.log(response, function(Key, value) {
                    $('#user_id').val(value[0]);
                    $('#Username').val(value[1]);
                    $('#Password').val(value[2]);
                    $('#AccessLevel').val(value[3]);
                });
            $('#editModal').modal('show');
        }
    </script>
    
</body>

</html>