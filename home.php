<?php
session_start();
include ('config.php');
include('lock.php');
$un = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Knit Knot Nook</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="icon" href="image/logo1.png">
    <link rel="stylesheet" href="Assets/bootstrap-5.3.3-dist/css/bootstrap.css">
    <script src="Assets/bootstrap-5.3.3-dist/js/bootstrap.js"></script>
    <script src="Assets/jquery-3.7.1.min.js"></script>
    <style>
        a {
            text-decoration: none;
        }

        .item_count {
            position: absolute;
            font-size: 20px;
            margin-left: 25px;
            margin-top: 20px;
        }

        .plawer {
            margin-left: 50px;
            margin-bottom: 200px;
        }

        .hand {
            margin-left: 350px;

        }

        .tri {
            background-size: fit;
            width: 186vh;
            height: 90vh;
            margin-left: -450px;
            background-image: url(image/pexels.jpg);
            background-size: fit;
            /* display: grid; */
            /* grid-template-columns: repeat(2, 1fr); */
            align-items: center;

        }

        #pre {
            position: absolute;
            text-align: center;
            margin-left: 150px;
            font-size: 60px;
            overflow: hidden;
            margin-top: 30px;
            color: #001B41;
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

    <!--home-->
    <section class="home" id="home">
        <div class="home-text">
            <h1 class="hand">
                <pre id="pre" style="font-family: Tahoma; margin-bottom: 200px; ">                        Handcrafted
        with love, just for you</pre>
            </h1>
        </div>

        <div>
            <img class="tri" src="image/pexels.jpg">
        </div>

    </section>


    <!--end-home-->


    <!-- footer starts -->
    <?php
    include ('footer.php');
    ?>

    <script>

        let menu = document.querySelector('#menu-icon');
        let navigation = document.querySelector('.navigation');

        menu.onclick = () => {
            menu.classList.toggle("X");
            navigation.classList.toggle('open');
        }

        document.getElementById("cart").addEventListener("click", function () {
            window.location.href = "cart.php";
        });
    </script>
</body>

</html>