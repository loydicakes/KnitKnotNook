<?php
session_start();
include('config.php');
// include('lock.php');
$un=$_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Knit Knot Nook</title>
    <link rel="stylesheet" type="text/css" href="style.css" /> 
    <link rel="icon" href="image/logo1.png" alt="logo">
    <link rel="stylesheet" href="Assets/bootstrap-5.3.3-dist/css/bootstrap.css">
    <script src="Assets/bootstrap-5.3.3-dist/js/bootstrap.js"></script>
    <script src="Assets/jquery-3.7.1.min.js"></script>
    <style>
        .item_count {
            position: absolute;
            font-size: 20px;
            margin-left: 25px;
            margin-top: 20px;
        }
        html{
            overflow: scroll;
        }
    </style>

 </head>
 <body>
    <header>
        <img id="logo" src="image/logo1.png" alt="">
         <h2 class="title">Knit Knot Nook</h2>

         <ul id="navigation" class="navigation">
            <li><a href="home.php">Home</a></li>
            <li><a href="shop.php">Shop</a></li>
            <li><a href="about.php">about</a></li>
            <li><a href="review.php">Review</a></li>
        </ul>

        <div class="btn-icon">
            <a href="logout.php" class="nav-btn" class="sign-up">Log out</a>
            <div id="menu-icon">☰</div>
        </div>
        <div class="cart" id="cart">
            <p class="item_count">
                <?php
                $sql = "SELECT * FROM tblcart WHERE Username='$un'";
                $sql_run = mysqli_query($conn, $sql);

                echo mysqli_num_rows($sql_run);
                ?>
            </p>
            <img src="image/cart.png" alt="cart">
        </div>
        <style>
            a{
                text-decoration:none;
            }
            .cart_div{
                display:block;
                margin-left:40%;
                margin-top:10%;
                align-items:center;
                
            }
            section{
                background-color:white;
                height:60vh;
                
            }
        </style>
    </header>

    <!--home-->

    <section class="" id="home">
        <div class="cart_div">
        <h1>Checkout successfully!</h1>
        <p>You will be redirected back to the merchant in <span id="countdown">5</span> seconds.</p>
        </div>
        
    
    </section>
    <!--end-home-->


    <script>
        //JavaScript sequential countdown timer
        var seconds = 5;

        function countdown() {
            document.getElementById('countdown').textContent = seconds;
            seconds--;
            if (seconds >= 0) {
                setTimeout(countdown, 1000); // Call countdown function again after 1 second
            } else {
                window.location.href = 'cart.php'; // Redirect URL after countdown
            }
        }
        countdown(); // Start countdown on page load
    </script>
 </body>
</html>