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
            border-radius: 1px;
            cursor: pointer;
            font-size: 16px;
        }

        .logout-button>a {
            text-decoration: none;
        }

        .logout-button:hover {
            background-color: #cc0000;
        }
       


.form-container img {
   height: 60px;
   width: 60px;
   margin-top: 10px;
}

.form-container h1 {
   text-align: center;
   margin-top: 15px;
}

.form-container h4 {
   margin-top: 15px;

}
.form-container2{
   
   border: 2px solid wheat; /* Green border */
   background-color: wheat;
   padding: 10px; /* Add some padding for spacing */}
    </style>
</head>

<body>


    <div class="form-container">
        <div style="display:flex; justify-content:space-between;" class="form-container2">
            <img src="../image/logo.jpg" alt="" style="height: 60px; width: 60px; margin-top:10px;">
            <h1 style="text-align:center; margin-top:15px;">MY CART</h1>
            <div style="display:flex; justify-content:space-between; gap:0.5rem;">
            <h4 style=" margin-top:15px;">
                    <?php echo $username; ?>
                </h4>
            
            <form method="POST" style="background-color: #ff0000; border:none; height:3rem; padding:0px; margin-top:5px;" >     
              <button class="logout-button" type="logout" value="logout" name="logout">Logout</button>  
              <div class="button-container">
        <button class="button"><a href="../homepage.php" style="color: white; text-decoration: none;">Continue Shopping</a></button>
    </div>
    <style>
         .button-container {
            position: fixed;
            bottom: 20px; 
            right: 20px; 
        }

        .button {
            background-color: #007bff;
            color: #fff; 
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .button:hover {
            background-color: #0056b3; 
        }
    </style>  
             </form>

               
            </div>
        </div>
        <?php
if (isset($_POST['logout'])) {   session_unset();   session_destroy();  include('../test3.php'); echo "<script> location.href='../signin.html'; </script>"; }

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
                            <th>Delete</th>
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
                                <?php echo "$".$row['product_price']; ?>
                            </td>
                            <td>
                                <?php echo $row['cart_quantity']; ?>
                            </td>
                            <td><img src="./upload_image/<?php echo $row['product_img']; ?>" height="100"></td>
                            <td>
                            <a href="myorder.php?delete=<?php echo $row['cart_id']; ?>" class="btn"
                              style="width: fit-content;">
                             Remove
                           </a>
                           
                            </td>
                        </tr>

                        <?php
                    }
                    ?>
                    <?php
                        if (isset($_GET['delete'])) {
                            $id = $_GET['delete'];
                            $deleteQuery = "DELETE FROM cart WHERE cart_id = ?";
                         
                            $stmt = mysqli_prepare($conn, $deleteQuery);
                            mysqli_stmt_bind_param($stmt, "i", $id);
                         
                            if (mysqli_stmt_execute($stmt)) {
                               echo "<script> alert('Product Has Been Deleted'); </script>";
                                  $_SESSION['success_message'] = "Product Deleted Successfully";
                                  echo '<script>setTimeout(function(){ window.location.href = "myorder.php"; }, 100);</script>';
                               
                            } else {
                               echo "Error deleting product: " . mysqli_error($conn);
                            }
                            }
                            mysqli_stmt_close($stmt);
                           ?>
                </table>
            </div>
            <h1 style=" background-color: wheat;
            color: #wheat;
            height: 3rem;
            border: none;
            padding: 10px 20px;
            border-radius: 1px;
            cursor: pointer;
            font-size: 16px;">Total:
                <?php echo "$".$total; ?>
            </h1>

            <form action="order.php" method="POST" style="margin-top: 40px; text-align:center; height:200px; width: 280px;" >
    <h1>Place order</h1>
    <br>
    <?php foreach ($productRows as $index => $product) { ?>
        <input type="hidden" name="productid[]" value="<?php echo $product['product_id']; ?>">
        <input type="hidden" name="quantity[]" value="<?php echo $product['cart_quantity']; ?>">
    <?php } ?>
    <br>
    <input type="submit" value="Confirm Order" name="myorder" style=" background-color: green;
            color: #ffffff;
            height: 3rem;
            border: none;
            padding: 10px 20px;
            border-radius: 1px;
            cursor: pointer;
            font-size: 16px;
            margin-top:-200px;">
            
</form>



            </section> <!-- main -->


</body>

</html>