<style>
    #babalogo{
        margin-left: 250px;
        width: 60px;
        height: 60px;
        margin-top: -55px;
    }
    .sec-info{
        margin-left: 20px;
    }
    .first-info{
        margin-right: -30px;
    }
    .third-ino{
        cursor: pointer;
    }
    .contact-info{
        margin-left: 80px;
        
    }
</style>

<footer>
        <section class="contact" style="background-color :whitesmoke; height:fit-content;">
            <div class="contact-info" style="background-color :whitesmoke; height:22vh;">
                
                <div class="first-info">
                    <h2>Knit Knot Nook</h2>
                    <img id="babalogo" src="image/logo1.png" alt="">
                    <p>Handcrafted with love, just for you</p>
                </div>
                <div class="sec-info">
                    <h4>MENU</h4>
                    <a href="home.php">
                        <p>Home</p>
                    </a>
                    <a href="shop.php" style="margin-top:-18px; position:absolute;">
                        <p>Shop</p>
                    </a>
                    <a href="about.php" style="margin-top:10px; position:absolute;">
                        <p>About</p>
                    </a>
                    <a href="review.php" style="margin-top:35px; position:absolute;">
                        <p>Review</p>
                    </a>
                </div>
                
                <div class="third-ino">
                    <h4>CONTACT US</h4>
                    <div style="display:flex;">
                        <img src="image/telephone.png" alt="" style="width:20px; height:20px; margin-right:5px; margin-top:2px;">
                        <p>+63 967 492 0832</p>
                    </div>
                    <div style="display:flex;">
                        <img src="image/email.png" alt="" style="width:20px; height:20px; margin-right:5px; margin-top:2px;">
                        <p>knitknotnook8@gmail.com</p>
                    </div>
                    
                </div>
                <div class="fourth-info">
                    <h4>FOLLOW US</h4>
                    <a target="_blank" href="https://www.facebook.com/profile.php?id=61556750472278"><img src="image/facebook.png" alt=""></a>
                    <a target="_blank" href="https://www.instagram.com/knit.knotnook?igsh=OWcyNDd6dmdvZHpr"><img src="image/instagram.png" alt=""></a>
                    <a target="_blank" href="https://www.tiktok.com/@knit.knot.nook?_t=8nSH3U3251L&_r=1"><img src="image/tiktok.png" alt=""></a>
                </div>

            </div>
        </section>
    </footer>
<script>
        document.getElementById("logo").addEventListener("click", function() {
            window.location.href = "home.php";
        });
        document.getElementById("babalogo").addEventListener("click", function() {
            window.location.href = "home.php";
        });
</script>