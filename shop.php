<?php
session_start();
include('config.php');
include('lock.php');
$un=$_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Knit Knot Nook</title>
    <link rel="stylesheet" type="text/css" href="shop.css" />
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="image/logo1.png">
    <link rel="stylesheet" href="Assets/bootstrap-5.3.3-dist/css/bootstrap.css">
    <script src="Assets/bootstrap-5.3.3-dist/js/bootstrap.js"></script>
    <script src="Assets/jquery-3.7.1.min.js"></script>
    <style>
        a{
            text-decoration: none;
        }
        .item_count {
            position: absolute;
            font-size: 20px;
            margin-left: 25px;
            margin-top: 20px;
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

    </header>
    <!--Category-->

    <section class="shop" id="shop">

        <div class="center-text">
            <h4>made with love</h4>
            <h2>Choose what's best for you</h2>
        </div>

        <div class="category">
            <div class="flower" id="flower" style="cursor: pointer;">
                <img src="image/flowerrrr.png" alt="">
                <h4 class="f">FLOWER</h4>
            </div>
            <div class="headband" id="headband" style="cursor: pointer;">
                <img src="image/headband.png" alt="">
                <h4 class="h">HEADBAND</h4>
            </div>
            <div class="keychain" id="keychain">
                <img src="image/keychain.png" alt="" style="cursor: pointer;">
                -<h4 class="k">KEYCHAIN</h4>
            </div>
            <div class="bag" id="bag">
                <img src="image/bag.png" alt="" style="cursor: pointer;">
                <h4 class="b">BAG</h4>
            </div>
        </div>
    </section>
    <style>
    .flower img:hover,.headband img:hover,.bag img:hover,.keychain img:hover{
    transform: scale(1.1);
    cursor: pointer;
    }
    a{
        text-decoration: none;
    }
    </style>
    <!--end-category-->
    <?php
        include('footer.php');
        ?>

    <script>
        let menu = document.querySelector('#menu-icon');
        let navigation = document.querySelector('.navigation');

        menu.onclick = () => {
            menu.classList.toggle("X");
            navigation.classList.toggle('open');
        }

        document.getElementById("flower").addEventListener("click", function() {
            window.location.href = "flower.php";
        });

        document.getElementById("headband").addEventListener("click", function() {
            window.location.href = "headband.php";
        });

        document.getElementById("keychain").addEventListener("click", function() {
            window.location.href = "keychain.php";
        });

        document.getElementById("bag").addEventListener("click", function() {
            window.location.href = "bag.php";
        });

        document.getElementById("cart").addEventListener("click", function() {
            window.location.href = "cart.php";
        });
    </script>
</body>

</html>