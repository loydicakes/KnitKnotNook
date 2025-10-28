<?php
session_start();
include ('config.php');
include('lock.php');
$un = $_SESSION['username'];


if (isset($_POST['review_submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $comment = $_POST['comment'];

    $insert_query = "INSERT INTO tblreview(Username,Email,Comment) VALUES('$name','$email','$comment')";
    $insert_query_run = mysqli_query($conn, $insert_query);
    if ($insert_query_run) {
        header("Location: review.php");
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
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="review.css" />
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
        .review{
            margin-bottom: 100px;
        }
        .box, .comment-box{
            border-radius:25px;
        }
        input{
            border-radius:5px;
        }
        .review .box-container{
    display: flex;
    flex-wrap: wrap;
    gap: 1.5rem;
    margin: 10px;
}

.review .box-container .box{
    flex: 1 1 30rem;
    box-shadow: 0 .2rem .5rem rgb(253, 177, 202);
    padding: 3rem 2rem;
    position: relative;
    border: .1rem solid rgba(0, 0, 0, .1);
}


.review .box-container .box .p{
    color: #999;
    font-size: 1.5rem;
    line-height: 1.5;
    padding-top: 2rem;
    font-family: Tahoma;

}

.review .box-container .box .user{
    display: flex;
    align-items: center;
    padding-top: 2rem;
}

.review .box-container .box .user img{
    height: 6rem;
    width: 6rem;
    border-radius: 50%;
    object-fit: cover;
    margin-right: 1rem;
}

.review .box-container .box .user h3{
    font-size: 2rem;
    color: #d4695d;
    font-family: Tahoma;
}

.review .box-container .box .user span{
    font-size: 1.2rem;
    color:#d4695d;
}


/*leave a comment*/
.comment-box{
    width: 86%;
    height: 400px;
    border: 1px solid #ccc;
    margin: 50px 0;
    padding: 10px 20px;
    border-radius: 20px;
    margin-left: 100px;
    margin-top: 80px;
    box-shadow: 0px 0px 5px 1px rgb(253, 177, 202);
}

.comment-box p{
    text-align: left;
    font-size: 28px;
    color: #777;
    font-family: Tahoma;
}

.comment-form input, .comment-form textarea{
    width: 100%;
    padding: 10px;
    margin: 5px 0;
    box-sizing: border-box;
    outline: none;
    font-size: 18px;
    border: 1px solid #ddd;
    color: #777;
    font-family: Tahoma;
}

.comment-form button{
    margin: 10px;
    border: none;
    padding: 10px;
    font-size: 15px;
    border-radius: 3px;
    color: #ffffff;
    border-radius: 10px;
}

.comment-form button:hover{
    color: white;
    background-color: #595959;
}
.box p{
    position: absolute;
}

@media(max-width: 900px){
    .comment-box{
        width: 80%;
        margin: 5%;
    }
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
    <section class = "review" id = "review">

        <div class="center-text">
        <h4>made with love</h4>
        <h2>Customer's Review</h2>
        </div>
       
        <div class="box-container" style="margin-top:-50px;">
            <div class="box">
                <p>The flowers were truly exquisite! They pay much attention to details. Whether you're looking for a timeless centerpiece ir unique gift, their handmade flowers are highly recommended! Bukod pa ron, sinusunod talaga nila yung gusto ng customer, tsaka ang mumura pa. Order na kayo.</p>
                <hr style="margin-bottom: -10px; margin-top:180px;">
                <div class = "user">
                    <img src= "image/id.jpg" alt="">
                    <div class = "user-info">
                        <h3>Jan Lloyd Cagoco</h3>
                        <span>cagocojanlloyd@gmail.com</span>
                    </div>
                </div>
            </div>

            <div class="box">
                <p>The best ang Knit-Knot Nook productsss! High and super ganda ng quality!🫶🏻🫶🏻🫶🏻 Tysm, more products to sell!✨
                </p>
                <hr style="margin-bottom: -10px; margin-top:180px;">
                <div class = "user">
                    <img src= "image/annie.jpg" alt="">
                    <div class = "user-info">
                        <h3>Annie Agustin</h3>
                        <span>agustinannie495@gmail.com</span>
                    </div>
                </div>
                <span class="fas fa-quote-right"></span>
            </div>

            <div class="box">
                <p>ang gandaaa ng pagkakagawaaaa!! da best order na rin saw kayoo </p>
                <hr style="margin-bottom: -10px; margin-top:180px;">
                <div class = "user">
                    <img src= "image/lou.jpg" alt="">
                    <div class = "user-info">
                        <h3>Sherilou Tan</h3>
                        <span>tansherilou@gmail.com</span>
                    </div>
                </div>
                <span class="fas fa-quote-right"></span>
            </div>
        </div>

        <!--comment-->
        <div class = "comment-box">
            <p>Leave a comment</p>
            <form class="comment-form" method="POST">
                <input type="text" placeholder="Name" name="name">
                <input type="email" placeholder="Email" name="email">
                <textarea rows="4" placeholder="Write your comment" name="comment"></textarea>
                <button type="submit" name="review_submit" class="btn btn-dark">Post Comment</button>
            </form>
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

        document.getElementById("cart").addEventListener("click", function() {
            window.location.href = "cart.php";
        });
    </script>

</body>
</html>