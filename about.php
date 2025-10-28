<?php
session_start();
include('lock.php');
include('config.php');
$un = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title href="home.php">Knit Knot Nook</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" href="about.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="image/logo1.png" href="home.php" alt="logo">
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

        .mission,
        .story_p {
            font-size: 20px;
            font-family: Tahoma;
        }

        #mission {
            width: 400px;
            height: 400px;
            margin-left: 825px;
            margin-top: -350px;
            border-radius: 1000px;
        }

        #story {
            width: 400px;
            height: 400px;
            margin-left: -50px;
            margin-top: -400px;
            border-radius: 1000px;
        }

        .story_content {
            margin-top: -100px;
        }

        .story {
            margin-top: 350px;
        }
    </style>

</head>

<body>
    <header>
        <img id="logo" src="image/logo1.png" alt="logo">
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
                $sql = "SELECT * FROM `tblcart` WHERE `Username` = '$un'";
                $sql_run = mysqli_query($conn, $sql);

                echo mysqli_num_rows($sql_run);
                ?>
            </p>
            <img src="image/cart.png" alt="cart">
        </div>

    </header>

    <!--about-->
    <section class="about" id="about">
        <div class="center-text">
            <h4>made with love</h4>
            <h2>we'll share our journey</h2>
        </div>
        <div class="mission">
            <h1>Our Mission</h1>
            <p>Our mission is to spread joy through the art of handmade crochet. We take pride in creating unique and high-quality crochet products that bring warmth and beauty to everyday life. With a commitment to craftsmanship and creativity, we aim to inspire our customers to cherish the tradition of handmade goods while providing them with exceptional service and a personal touch. We strive to foster a community of artisans and enthusiasts who share our passion for creativity and appreciation for handmade craftsmanship.</p>
            <img id="mission" src="image/page.jpg" alt="page">
        </div>
        <div class="story">
            <div class="story_content">
                <h1>Our Story</h1>
                <p class="story_p">In a vibrant town, our journey began with the unwavering support of close friends. What started as a shared dream over coffee evolved into the creation of handcrafted crochet sling bags, blending artistry with sustainability.

                    Each bag is a testament to our commitment to high-quality craftsmanship and eco-friendly materials. The intricate designs and vibrant colors reflect the care and creativity behind every piece.

                    We are deeply grateful to our friends and customers for their belief in our vision. Together, we foster a community that values sustainability, artistry, and genuine connection.

                    Welcome to our handcrafted collection. Thank you for being part of our story.</p>
            </div>

            <img id="story" src="image/mission.jpg" alt="mission">
        </div>
    </section>
    <!--end-about-->
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
        document.getElementById("cart").addEventListener("click", function() {
            window.location.href = "cart.php";
        });
    </script>
</body>

</html>