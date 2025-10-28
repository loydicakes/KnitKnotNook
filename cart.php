<?php
session_start();
include('config.php');
require_once('component.php');
include('lock.php');
$db = new Database();
$un = $_SESSION['username'];


if (isset($_POST['remove'])) {
    $id = $_POST['product_id'];
    $sql = "DELETE FROM tblcart WHERE `tblcart`.`ProductID` = '$id'";
    $sql_query_run = mysqli_query($conn, $sql);

    if ($sql_query_run)
        header("Location: cart.php");
    else
        echo mysqli_error($conn) . " ERROR";
}

if (isset($_POST['order_submit'])) {

    // Step 1: Execute the SELECT query to get the names from tblcart
    $sql = "SELECT Name FROM tblcart WHERE Username='$un'";
    $sql_run = mysqli_query($conn, $sql);

    if ($sql_run) {
        // Initialize an array to store item names and their counts
        $item_counts = [];

        // Fetch each row and count occurrences of each item name
        while ($row = mysqli_fetch_assoc($sql_run)) {
            $name = mysqli_real_escape_string($conn, $row['Name']);
            if (isset($item_counts[$name])) {
                $item_counts[$name]++;
            } else {
                $item_counts[$name] = 1;
            }
        }

        // Initialize a success flag
        $success = true;

        // Check if all items in tblflower have sufficient quantities
        foreach ($item_counts as $name => $count) {
            // Step 2: Query to check if Current_quantity is sufficient
            $check_quantity_sql = "SELECT Current_quantity FROM tblflower WHERE Item_name = '$name'";
            $check_quantity_result = mysqli_query($conn, $check_quantity_sql);

            if ($check_quantity_result) {
                $flower_row = mysqli_fetch_assoc($check_quantity_result);
                $current_quantity = $flower_row['Current_quantity'];

                // Check if current_quantity is sufficient for checkout
                if ($current_quantity < $count) {
                    $success = false;
                    // echo "Error: Insufficient quantity for item '$name'.<br>";

                    $_SESSION['status'] = "Insufficient quantity for item '$name'";
                    if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
?>
                        <div id="alert-container" style="position: fixed; bottom: 16%; left: 79.6%; transform: translateX(-50%); width: 505px; height:auto;">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert" style="align-items:end;">
                                <strong>Error! </strong> <?php echo $_SESSION['status']; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
<?php
                        unset($_SESSION['status']);
                    }
                }
            } else {
                $success = false;
                echo "Error checking quantity for item '$name'. Error: " . mysqli_error($conn) . "<br>";
            }
        }

        if ($success) {
            // Initialize success flag
            $success = true;

            // Array to store item names
            $item_names = "";

            // Loop through each item name and update tblflower
            foreach ($item_counts as $name => $count) {
                // Escape variables for safety
                $name_escaped = mysqli_real_escape_string($conn, $name);
                $count_escaped = mysqli_real_escape_string($conn, $count);

                $update_quantity = "UPDATE tblflower SET Current_quantity = Current_quantity - $count_escaped WHERE Item_name = '$name_escaped'";
                $update_quantity_run = mysqli_query($conn, $update_quantity);

                // Check if update query was successful
                if (!$update_quantity_run) {
                    $success = false;
                    echo "Error updating quantity for item: " . $name . ". Error: " . mysqli_error($conn) . "<br>";
                    break; // Exit loop on failure
                } else {
                    // Store the item name in the array
                    $item_names = $item_names."[".$name."] ";
                }
            }

            // Debugging: Print item names
            print_r($item_names);

            // Redirect to success page upon successful update
            if ($success) {
                $costumer = mysqli_real_escape_string($conn, $un);
                $address = mysqli_real_escape_string($conn, $_POST['costumer_address']);
                $paymentoption = mysqli_real_escape_string($conn, $_POST['payment_option']);
                $shipcost = mysqli_real_escape_string($conn, $_POST['shipping_cost']);
                $totalcost = mysqli_real_escape_string($conn, $_POST['adjusted_total']);

                // Convert item names array to a comma-separated string
                $item_names_str = $item_names;

                $insert_query = "INSERT INTO tblship(Costumer, item, Address, PaymentOption, ShipCost, TotalCost) VALUES('$costumer', '$item_names_str', '$address', '$paymentoption', '$shipcost', '$totalcost')";
                $insert_query_run = mysqli_query($conn, $insert_query);

                if ($insert_query_run) {
                    header("Location: success_page.php");
                    exit(); // Ensure script termination after redirection
                } else {
                    echo "Error inserting shipping information: " . mysqli_error($conn) . "<br>";
                }
            }
        }
    } else {
        // Debugging error message for failed SELECT query
        echo "Error retrieving cart items: " . mysqli_error($conn);
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
    <link rel="stylesheet" href="cart.css">
    <link rel="icon" href="image/logo1.png" alt="logo">
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

        .row {
            height: 20vh;
        }

        .row img {
            height: 20vh;
            width: 20vh;
        }

        .shopping-cart {
            padding: 3% 0;
        }

        .cart-items {
            display: block;
        }

        .cart-items+.cart-items {
            padding: 2% 0;
        }

        .addCart {
            margin-top: 90px;
            width: 100%;
            height: auto;
            background-color: white;

        }

        .price-details h6 {
            padding: 3% 2%;
        }

        .tot_price {
            position: fixed;
            margin-left: 110vh;
        }

        .header {
            position: fixed;

        }

        html {
            overflow-y: scroll;
        }
    </style>

</head>

<body>
    <header class="header">
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
                $sql = "SELECT * FROM tblcart WHERE Username='$un'";
                $sql_run = mysqli_query($conn, $sql);

                echo mysqli_num_rows($sql_run);
                ?>
            </p>
            <img src="image/cart.png" alt="cart">
        </div>

    </header>

    <!--cart-->

    <section class="addCart" id="addCart">
        <div class="back-button" id="back-button">
            <img src="image/back-button.png" alt="button">
        </div>

        <div class="container-fluid">
            <div class="row px-5">
                <div class="col-md-7">
                    <div class="shopping-cart">
                        <h6>Checkout for love</h6>
                        <hr>
                        <?php
                        $sql = "SELECT * FROM tblcart WHERE Username='$un'";
                        $sql_run = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($sql_run) == 0) {
                            echo "No item/s in the cart";
                        } else if (mysqli_num_rows($sql_run) > 0) {
                            while ($rows = mysqli_fetch_array($sql_run)) {
                                cartElement($rows['Name'], $rows['Image'], $rows['Price'], $rows['ProductID']);
                                $total = $total + (int)$rows['Price'];
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white tot_price" style="height: 380px;">
                    <?php
                    $tot_item = mysqli_num_rows($sql_run);
                    ?>
                    <form action="" method="POST">
                        <div class="pt-4">
                            <h5><b>Price Breakdown: </b></h5>
                            <hr>
                            <div class="row price-details">
                                <div class="col-md-6">
                                    <?php
                                    $tot_item = mysqli_num_rows($sql_run);
                                    if (mysqli_num_rows($sql_run) > 0) {
                                        echo "<h6> All item/s in total: </h6>";
                                    } else {
                                        echo "<h6>No item/s in the cart</h6>";
                                    }
                                    ?>
                                    <h6>Location: </h6>

                                    <h6>Delivery Charges: </h6>
                                    <h6>Payment option: </h6>
                                    <hr style="width: 210%;">
                                    <h6>Total: </h6>
                                </div>
                                <div class="col-md-6">
                                    <h6>₱ <span id="displayTotal"> <?php echo $total; ?></h6>
                                    <div class="form-group">
                                        <select style="margin-top: 12px;" class="form-control" name="location" id="location" required onchange="updateShippingCost()">
                                            <option value="" selected disabled>---</option>
                                            <option value="Tallang, Baggao, Cagayan">Tallang, Baggao, Cagayan</option>
                                            <option value="Remus, Baggao, Cagayan">Remus, Baggao, Cagayan</option>
                                            <option value="J. Pallagao, Baggao, Cagayan">J. Pallagao, Baggao, Cagayan</option>
                                            <option value="Buyun, Sta. Teresita, Cagayan">Buyun, Sta. Teresita, Cagayan</option>
                                            <option value="Masin, Alcala, Cagayan">Masin, Alcala, Cagayan</option>
                                            <option value="Minanga, Claveria, Cagayan">Minanga, Claveria, Cagayan</option>
                                            <option value="Casambalangan, Sta. Ana, Cagayan">Casambalangan, Sta. Ana, Cagayan</option>
                                        </select>
                                    </div>


                                    <!-- Hidden fields for storing shipping cost and adjusted total -->
                                    <input type="hidden" name="costumer_address" id="costumer_address" value="">
                                    <input type="hidden" name="shipping_cost" id="shipping_cost" value="">
                                    <input type="hidden" name="adjusted_total" id="adjusted_total" value="">
                                    <input type="hidden" name="payment_option" id="payment_option" value="payment">
                                    <h6 id="shippingCostText" style="padding-bottom: -20px;">

                                        <div class="text-success">Free</div>
                                    </h6>
                                    <div class="form-group">
                                        <select style="margin-top: 12px;" class="form-control" name="payment" id="payment" onchange="updateShippingCost()" required>
                                            <option value="" selected disabled>---</option>
                                            <option value="Cash on delivery">Cash on delivery</option>
                                            <option value="Online payment">Online payment</option>
                                        </select>
                                    </div>
                                    <br>
                                    <h6>₱ <span id="displayAdjustedTotal"><?php echo $total; ?></h6>
                                    <br>
                                    <button type="submit" name="order_submit" class="btn btn-primary" style="margin-left: 90px; background: rgb(253, 177, 202); border: none;">Submit Order</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
    <!--end-cart-->

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

        document.getElementById("back-button").addEventListener("click", function() {
            window.location.href = "shop.php";
        });

        function updateShippingCost() {
            var selectedLocation = document.getElementById("location").value;
            var shipping_cost = 0; // Default shipping cost
            var last = 0;
            var totItem = <?php echo $tot_item; ?>;
            // Determine shipping cost based on selected location
            if (selectedLocation === "Remus, Baggao, Cagayan") {
                shipping_cost = 50;
            } else if (selectedLocation === "Tallang, Baggao, Cagayan") {
                // Add more conditions for other locations if needed
                shipping_cost = 30;
            } else if (selectedLocation === "J. Pallagao, Baggao, Cagayan") {
                shipping_cost = 40;
            } else if (selectedLocation === "Buyun, Sta. Teresita, Cagayan") {
                shipping_cost = 200;
            } else if (selectedLocation === "Masin, Alcala, Cagayan") {
                shipping_cost = 100;
            } else if (selectedLocation === "Minanga, Claveria, Cagayan") {
                shipping_cost = 300;
            } else if (selectedLocation === "Casambalangan, Sta. Ana, Cagayan") {
                shipping_cost = 200;
            }
            if (totItem >= 20) {
                last = shipping_cost + shipping_cost + shipping_cost; // Triple shipping cost
            } else if (totItem >= 10) {
                last = shipping_cost + shipping_cost; // Double shipping cost
            } else if (totItem >= 0) {
                last = shipping_cost; //shipping cost
            }

            // Update shipping cost text
            document.getElementById("shippingCostText").innerHTML = "₱ " + last;

            // Get current total
            var currentTotal = parseFloat(document.getElementById("displayTotal").innerText);

            // Calculate adjusted total
            var adjustedTotal = currentTotal + last;

            // Update displayed adjusted total
            document.getElementById("displayAdjustedTotal").innerText = adjustedTotal.toFixed(2);

            var pay = document.getElementById("payment").value;
            var loc = document.getElementById("location").value;
            // Update hidden input fields
            document.getElementById("shipping_cost").value = last;
            document.getElementById("adjusted_total").value = adjustedTotal.toFixed(2);
            document.getElementById("payment_option").value = pay;
            document.getElementById("costumer_address").value = loc;
        };
    </script>
</body>

</html>