<?php
include_once('connection.php');
session_start();
$username = $_SESSION['username']

    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    <script>
        // Check local storage
        let localS = localStorage.getItem('theme'),
            themeToSet = localS

        // If local storage is not set, we check the OS preference
        if (!localS) {
            themeToSet = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
        }

        // Set the correct theme
        document.documentElement.setAttribute('data-theme', themeToSet)
    </script>

    <!-- Reset -->

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
       


    <link rel="stylesheet" href="./product.css">

    <style>
        .logout-button {
            background-color: #ff0000;
            color: #ffffff;
            height: 3rem;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .logout-button>a {
            text-decoration: none;
        }

        .logout-button:hover {
            background-color: #cc0000;
        }
    </style>
</head>

<body>


    <div class="form-container">
        <div style="display:flex; justify-content:space-between">
            <img src="../image/logo.jpg" alt="" style="height: 60px; width: 60px;">
            <h1 style="text-align:center;">My Card</h1>
            <div style="display:flex; justify-content:space-between; gap:2rem;">
            
            <form method="POST">       <button class="nav-item logout" type="logout" value="logout" name="logout">Logout</button>     </form>

                <h1>
                    <?php echo $username; ?>
                </h1>
            </div>
        </div>
        <?php
if (isset($_POST['logout'])) {   session_unset();   session_destroy();   echo "<script> location.href='../signin.html'; </script>"; }

?>
        <div class="admin-product-form-container">
            <?php
            $user_id = $_SESSION['ID'];
            $select = "SELECT c.*, p.* FROM cart c
           INNER JOIN products p ON p.id = c.product_id
           WHERE c.user_id = ?";
            $stmt = mysqli_prepare($conn, $select);
            mysqli_stmt_bind_param($stmt, "i", $user_id); // Assuming user_id is an integer
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $sn = 1;
            $total = 0;
            $productRows = []; // Array to store the rows
            
            while ($row = mysqli_fetch_assoc($result)) {
                $total += $row['product_price'] * $row['cart_quantity'];
                $productRows[] = $row; // Store each row in the array
            }
            ?>

            <div class="product-display">
                <table class="product-display-table">
                    <thead>
                        <tr>
                            <th>S.N</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Image</th>
                            <th>product id</th>
                        </tr>
                    </thead>
                    <?php
                    foreach ($productRows as $row) {
                        ?>

                        <tr>
                            <td>
                                <?php echo $sn++; ?>
                            </td>
                            <td>
                                <?php echo $row['product_name']; ?>
                            </td>
                            <td>
                                <?php echo $row['product_price']; ?>
                            </td>
                            <td>
                                <?php echo $row['cart_quantity']; ?>
                            </td>
                            <td><img src="./upload_image/<?php echo $row['product_img']; ?>" height="100"></td>
                            <td>
                                <?php echo $row['product_id']; ?>
                            </td>
                        </tr>

                        <?php
                    }
                    ?>
                </table>
            </div>
            <h1>Total:
                <?php echo $total; ?>
            </h1>

            <form action="order.php" method="POST">
    <h1>Confirm your order</h1>
    <br>
    <?php foreach ($productRows as $index => $product) { ?>
        <input type="hidden" name="productid[]" value="<?php echo $product['product_id']; ?>">
        <input type="hidden" name="quantity[]" value="<?php echo $product['cart_quantity']; ?>">
    <?php } ?>
    <br>
    <input type="submit" value="Confirm Order" name="myorder">
</form>



            </section> <!-- main -->


</body>

</html>