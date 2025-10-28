<?php
session_start();
include('config.php');
require_once('component.php');
include('lock.php');
$db = new Database();
$un = $_SESSION['username'];

if (isset($_POST['add'])) {
    $id = $_POST['product_id'];

    // Initialize variables to store product data
    $p_name = '';
    $p_img = '';
    $p_price = 0.0;

    // Get product data from the database
    $result = $db->getData_flower();
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['ProductID'] == $id) { // Find the specific product
            $p_name = $row['Item_name'];
            $p_img = $row['Item_image'];
            $p_price = $row['Item_price'];
            break; // Exit the loop once the product is found
        }
    }

    // Prepare the SQL query to insert data into the cart
    $p_username = $un;
    $insert_query = "INSERT INTO tblcart (ProductID, Name, Image, Price, Username) VALUES ('$id', '$p_name', '$p_img', '$p_price', '$p_username')";
    $insert_query_run = mysqli_query($conn, $insert_query);

    if ($insert_query_run) {
        header('location: flower.php');
    } else {
        echo "Error: " . mysqli_error($conn); // Output the error message
        // Alternatively, redirect with an error message
        // header('location: flower.php?error=insert_failed');
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Knit Knot Nook</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="shop-category.css">
    <link rel="icon" href="image/logo1.png">
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

        a {
            text-decoration: none;
        }

        .card img {
            width: 100%;
            height: 30vh;
        }

        form {
            height: 50px;
            width: 250px;
            background-color: white;
            margin-bottom: 50vh;
        }

        .card-text {
            position: absolute;
        }

        .items {
            margin-bottom: 300px;
            margin-left: 100px;

        }

        .drac {
            margin-left: -20px;
        }


        .all-item {
            display: block;
        }

        details p {
            background-color: pink;
            position: absolute;
            border-radius: 5px;
        }

        .catFlower {
            width: 100%;
            height: auto;
            background-color: white;
        }
        .oos{
            margin-right: 0px;
        }
        #btnmore{
         background: dimgrey;
         color:white;
        }
        #btnmore:hover{
            background-color:  #595959;
        }
        #btnadd{
        background: rgb(253, 177, 202);
        color: white;
        }
        #btnadd:hover{
            background-color: #c27580
        }
        .headFlower:hover, .headHeadband:hover, .headKeychain:hover, .headBag:hover{
            transform: scale(1.1);
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
            <li><a href="about.php">About</a></li>
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

    <!--flower-->

    <section class="catFlower" id="catFlower">
        <div class="catHeader">
            <div class="headFlower" id="headFlower" style="background: #FADDE1">
                <a href="flower.php">Flower</a>
            </div>
            <div class="headHeadband" id="headHeadband">
                <a href="headband.php">Head band</a>
            </div>
            <div class="headKeychain" id="headKeychain">
                <a href="keychain.php">Keychain</a>
            </div>
            <div class="headBag" id="headBag">
                <a href="bag.php">Bag</a>
            </div>
        </div>
        <div class="all-item">
            <div class="items">
                <div class="row text-center py-5">
                    <?php
                    $result = $db->getData_flower();
                    while ($row = mysqli_fetch_assoc($result)) {
                        if($row['Current_quantity']>9){
                            component($row['Item_name'], $row['Item_image'], $row['Item_price'], $row['Item_description'], $row['ProductID']);
                        }
                        elseif($row['Current_quantity']>0 && $row['Current_quantity']<10){
                            component_warning($row['Item_name'], $row['Item_image'], $row['Item_price'], $row['Item_description'], $row['ProductID'], $row['Current_quantity']);
                        }
                        else{
                            component_empty($row['Item_name'], $row['Item_image'], $row['Item_price'], $row['Item_description'], $row['ProductID']);
                        }
                        
                    }
                    
                    ?>
                </div>
            </div>
        </div>


    </section>
    <!--end-flower-->
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
        document.getElementById("headFlower").addEventListener("click", function() {
            window.location.href = "flower.php";
        });

        document.getElementById("headHeadband").addEventListener("click", function() {
            window.location.href = "headband.php";
        });

        document.getElementById("headKeychain").addEventListener("click", function() {
            window.location.href = "keychain.php";
        });

        document.getElementById("headBag").addEventListener("click", function() {
            window.location.href = "bag.php";
        });

        document.getElementById("cart").addEventListener("click", function() {
            window.location.href = "cart.php";
        });
        /////////funtions
    </script>
</body>

</html>