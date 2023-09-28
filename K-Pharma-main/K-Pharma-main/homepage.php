<?php
include_once('./php/connection.php');
$sql = "SELECT * FROM products JOIN categories ON categories.c_id = products.c_id";

$all_product = $conn->query($sql);
print_r($all_product);

$previous_category = null;
session_start();

$username =   $_SESSION['username']

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kids Pharmacy</title>
    <link rel="stylesheet" href="./css/newstyle.css">
    <link rel="stylesheet" href="./css/newproduct.css">
    <!-- Boxicons link-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- remix icons-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.4.0/fonts/remixicon.css" rel="stylesheet">
    <!-- google fonts link-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Signika+Negative:wght@400;500&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
  .icon-container {
    display: inline-block;
    position: relative;
    animation: zoomInOut 2s infinite;
  }

  .icon-container:hover .upload-option {
    display: block;
  }

  @keyframes zoomInOut {
    0%, 100% {
      transform: scale(1);
    }
    50% {
      transform: scale(1.2);
    }
  }


</style>
</head>

<body>
    <header class="sticky">
        <a href="#" class="logo"><img src="./image/logo.jpg" alt="" style="height: 40px; width: 40px;"></a>
        <ul class="navbar" style="gap: 40px;">
            <li><a href="homepage.php">Home</a></li>
            <li><a href="#" id="scrollToCategories">Categories</a></li>
            <li><a href="#" id="scrollToPartners">Partners</a></li>
            <li><a href="#" id="scrollToEquipments">Product</a></li>

        </ul>
        <div class="navicon">

            <a href="registration.php"><i class='bx bx-user'></i></a>
            <a href="./php/myorder.php"><i class='bx bx-cart' ></i></a>
            <div class="icon-container">
    <a href="./php/viewproducts.php"><i class='bx bx-menu'></i></a>
    
  </div>
        </div>
        <div class="cart" id="carts">
            <h2 class="cart-title">Your cart</h2>
            <!-- container -->
            <div class="cart-content">

            </div>
            <!-- Total -->
            <div class="total">
                <div class="total-title">Total:</div>
                <div class="total-price">$0</div>
            </div>

           
           
            <i class='bx bx-x' id="close-cart"> </i>
        </div>


    </header>
    <!-- -->
    <section class="home">
        <div class="home-text">
            <h1>KIDDO KART</h1>
            <p style="color: aliceblue; font-style: italic; font-size: larger;"> Where Every Click Unwraps Joy! Discover a world of delightfully curated toys, clothing, 
            and accessories for kids that spark imagination and create smiles.
            </p>
            <a href="#" class="main-btn">Shop Now <i class='bx bx-right-arrow-alt'></i></a>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const shopButton = document.querySelector(".main-btn");

                shopButton.addEventListener("click", function (event) {
                    event.preventDefault();
                    const targetSection = document.getElementById("equipments-section");
                    const targetPosition = targetSection.offsetTop;

                    window.scrollTo({
                        top: targetPosition,
                        behavior: "smooth"
                    });
                });
            });
        </script>






    </section>

    <section class="feature" id="categories-section">
        <div class="p-text" style="margin-bottom: 50px;">
            <h2> Categories </h2>
        </div>
        <div class="feature-content">
            <div class="row">
                <div class="row-img">
                    <img src="./homeImage/f1.jpg" alt="" id="scrollTrigger1">
                </div>
                <h4 id="scrollTrigger1">Equipments</h4>
                <script>
                    document.getElementById("scrollTrigger1").addEventListener("click", function () {
                        const section = document.getElementById("equipments-section");
                        section.scrollIntoView({ behavior: "smooth" });
                    });
                </script>





            </div>
            <div class="row">
                <div class="row-img">
                    <img src="./homeImage/f2.jpg" alt="">
                </div>
                <h4>Medicines</h4>
            </div>
            <div class="row">
                <div class="row-img">
                    <img src="./homeImage/f3.jpg" alt="">
                </div>
                <h4>Undergarments</h4>
            </div>
            <div class="row">
                <div class="row-img">
                    <img src="./homeImage/f4.jpg" alt="" id="scrollTrigger2">
                </div>
                <h4 id="scrollTrigger2">Vitamins</h4>
                <script>
                    document.getElementById("scrollTrigger2").addEventListener("click", function () {
                        const section = document.getElementById("vitamins-section");
                        section.scrollIntoView({ behavior: "smooth" });
                    });
                </script>
            </div>
            <div class="row">
                <div class="row-img">
                    <img src="./homeImage/f4.jpg" alt="">
                </div>
                <h4>Syrup</h4>
            </div>
        </div>
    </section>
    <!--Pharmacies partnered with-->
 
                   
    <?php
    while ($row = mysqli_fetch_assoc($all_product)) {
        $current_category = $row['c_title'];


        if ($current_category != $previous_category) {
            // Close the previous product container if it's not the first category
            if ($previous_category !== null) {
                echo '</div></section>';
            }
            // Open a new category section and product container
            ?>
            <section class="shop-container" id="equipments-section">
                <h2 class="section-title">
                    <?php echo $row['c_title']; ?>
                </h2>
                <div class="products">
                    <?php
                    $previous_category = $current_category;
        }
        ?>

                <!-- Product box for each product -->
                <div class="product-box">
                    <img class="product-img" src="./php/upload_image/<?php echo $row['product_img']; ?>"
                        alt="Product Image">
                    <div>
                        <h2 class="product-title">
                            <?php echo $row['product_name'] ?>
                        </h2>
                    </div>
                    <div class="description">
                        <p> <?php echo $row['descriptions'] ?></p>
                    </div>
                    <div>
                        <span class="price">
                            <?php echo "$ " . $row['product_price'] ?>
                        </span>
                    </div>

                    <div>
<!--                    
                        <button class="add-cart">
                            <i class='bx bx-shopping-bag add-cart'> ADD TO CART</i>
                        </button> -->
                        <form class="product-form" action="" method="POST">
            <input type="hidden" class="productid" name="productid" value="<?php echo $row['id'] ?>">
            <input type="number" class="quantity" value="1" name="quantity" min="1" max="12">
            <input type="submit" value="Add to Cart" class="gotocart" name="gotocart">
        </form>
                    </div>
                </div>
                

                <?php
    }
    ?>



        


            <?php
            // Close the last product container
            if ($previous_category !== null) {
                echo '</div></section>';
            }
            ?>


        </div>
        </div>

    </section>

    <section class="partners" id="partners-section">
        <div class="p-text">
            <h2> Our Partners </h2>
        </div>
        <div class="p-content">
            <div class="box">
                <img src="./homeImage/p1.jpeg" alt="">
                <h5>Smaagra Pharma</h5>
                <h4>Maharajgunj</h4>
            </div>
            <div class="box">
                <img src="./homeImage/p2.jpeg" alt="">
                <h5>Smaagra Pharma</h5>
                <h4>Maharajgunj</h4>
            </div>
            <div class="box">
                <img src="./homeImage/p3.jpeg" alt="">
                <h5>Smaagra Pharma</h5>
                <h4>Maharajgunj</h4>
            </div>
            <div class="box">
                <img src="./homeImage/p4.jpeg" alt="">
                <h5>Smaagra Pharma</h5>
                <h4>Maharajgunj</h4>
            </div>
            <div class="box">
                <img src="./homeImage/p5.jpg" alt="">
                <h5>Smaagra Pharma</h5>
                <h4>Maharajgunj</h4>
            </div>
            <div class="box">
                <img src="./homeImage/p6.jpeg" alt="">
                <h5>Smaagra Pharma</h5>
                <h4>Maharajgunj</h4>
            </div>
            <div class="box">
                <img src="./homeImage/p7.jpg" alt="">
                <h5>Smaagra Pharma</h5>
                <h4>Maharajgunj</h4>
            </div>
            <div class="box">
                <img src="./homeImage/p8.jpg" alt="">
                <h5>Smaagra Pharma</h5>
                <h4>Maharajgunj</h4>
            </div>
            <div class="box">
                <img src="./homeImage/p6.jpeg" alt="">
                <h5>Smaagra Pharma</h5>
                <h4>Maharajgunj</h4>
            </div>
            <div class="box">
                <img src="./homeImage/p6.jpeg" alt="">
                <h5>Smaagra Pharma</h5>
                <h4>Maharajgunj</h4>
            </div>

        </div>

    </section>

    <section class="footer">
        <div class="footer-box">
            <h3>Get to Know Us</h3>
            <a href="#">About Kids Pharmacy</a>
            <a href="#">Our Investors</a>
            <a href="#">Blog</a>

        </div>
        <div class="footer-box">
            <h3>Need Help</h3>
            <a href="#">Covid 19 emergency</a>
            <a href="#">Returns and Replacements</a>
            <a href="#">Shipping rates</a>

        </div>

        <div class="footer-box">

            <h3>Contact us</h3>
            <a href="#" style="display: flex;"><i class='bx bxs-phone-call'></i>
                <p>+977 9845654533</p>
            </a>
        </div>

    </section>

    <div class="copyright">
        <p>&copy; Copyright 2023 By Bisham Thapa</p>
    </div>
    <script>
        var closecart = document.getElementById("close-cart");
        closecart.addEventListener('click', function () {
            var cart = document.getElementById("carts");

            cart.style.display = 'none';

            //  alert(1);
        })


        var opencart = document.getElementById("cart-icon");
        opencart.addEventListener('click', function () {
            var cart = document.getElementById("carts");

            cart.style.display = 'block';

            //  alert(1);
        })




    </script>

    <script src="./javascript/newscript.js"></script>
    <!-- <script src="./javascript/prodduct.js"></script> -->
    <script src="./javascript/scroll.js"></script>
    



</body>

</html>


<script>
     $(document).ready(function () {
    $(".gotocart").on("click", function (e) {
        e.preventDefault();
        var form = $(this).closest('.product-form'); // Find the parent form
        var quantity = form.find('.quantity').val(); // Find the quantity input within the form
        var productid = form.find('.productid').val(); // Find the productid input within the form

        $.ajax({
            url: "test.php",
            type: "POST",
            data: { quantity: quantity, productid: productid },
            success: function (response) {
                alert("Added to Cart!");
            }
        });
    });
});

</script>